<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Command;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * Ajouter un produit à la commande du panier
     */
    public function ajouterProduit(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1|max:100'
        ]);

        $produit = Produit::findOrFail($request->produit_id);
        
        // Vérifier le stock
        if ($produit->quantite_stock < $request->quantite) {
            return back()->with('error', 'Stock insuffisant pour ce produit.');
        }

        // Créer ou récupérer la commande en cours (pending)
        $commande = Command::firstOrCreate(
            [
                'utilisateur_id' => 1, // ID utilisateur par défaut
                'statut' => 'en_attente'
            ],
            [
                'date_commande' => now(),
                'reference' => 'CMD-' . uniqid(),
                'montant_total' => 0
            ]
        );

        // Vérifier si le produit est déjà dans la commande
        $ligneExistante = $commande->lignes()->where('commande_id', $commande->id)
            ->where('produit_id', $produit->id)
            ->first();

        if ($ligneExistante) {
            // Mettre à jour la quantité
            $nouvelleQuantite = $ligneExistante->quantite + $request->quantite;
            
            if ($produit->quantite_stock < $nouvelleQuantite) {
                return back()->with('error', 'Stock insuffisant pour cette quantité.');
            }
            
            $ligneExistante->update([
                'quantite' => $nouvelleQuantite,
                'prix_total' => $nouvelleQuantite * $ligneExistante->prix_unitaire
            ]);
        } else {
            // Créer une nouvelle ligne
            $commande->lignes()->create([
                'commande_id' => $commande->id,
                'produit_id' => $produit->id,
                'quantite' => $request->quantite,
                'prix_unitaire' => $produit->prix,
                'prix_total' => $request->quantite * $produit->prix
            ]);
        }

        // Recalculer le total de la commande
        $total = $commande->lignes()->sum('prix_total');

        
        $commande->update(['montant_total' => $total]);

        return back()->with('success', 'Produit ajouté au panier avec succès!');
    }

    /**
     * Afficher le panier
     */
    public function panier()
    {
        $commande = Command::where('utilisateur_id', 1) // ID utilisateur par défaut
            ->where('statut', 'en_attente')
            ->with('lignes.produit')
            ->first();

        return view('shop.panier', compact('commande'));
    }

    /**
     * Payer la commande
     */
    public function payer($id)
    {
        $commande = Command::with('lignes.produit')->findOrFail($id);

        if ($commande->statut === 'confirmee') {
            return back()->with('error', 'Cette commande est déjà payée.');
        }

        try {
            DB::transaction(function () use ($commande) {
                foreach ($commande->lignes as $ligne) {
                    $produit = $ligne->produit;
                    
                    if ($produit->quantite_stock < $ligne->quantite) {
                        throw new \Exception("Stock insuffisant pour: {$produit->nom}");
                    }

                    // Diminuer le stock
                    $produit->decrement('quantite_stock', $ligne->quantite);
                }

                // Marquer la commande comme payée
                $commande->update([
                    'statut' => 'confirmee'
                ]);
            });

            return redirect()->route('client.shop.produits')
                ->with('success', 'Commande payée avec succès! Merci pour votre achat.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Afficher les commandes du client connecté
     */
    public function mesCommandes()
    {
        $commandes = Command::where('utilisateur_id', Auth::id())
            ->with('produits')
            ->with('lignes')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('commandes.mes-commandes', compact('commandes'));
    }
}
