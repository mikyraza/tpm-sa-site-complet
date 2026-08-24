/**
 * TPM SA (Groupe CAC) - Logic JS Principale
 * Gestion du Panier Pro-Forma B2B en LocalStorage & Calculs Fiscaux (TVA 19.25%)
 */

const TPM_CART_KEY = 'TPM_PROFORMA_CART';
const TVA_RATE = 0.1925; // 19.25% TVA Cameroun

// Obtenir le panier depuis LocalStorage
function getCart() {
    try {
        const data = localStorage.getItem(TPM_CART_KEY);
        return data ? JSON.parse(data) : [];
    } catch (e) {
        console.error('Erreur lecture cart:', e);
        return [];
    }
}

// Sauvegarder le panier
function saveCart(cart) {
    try {
        localStorage.setItem(TPM_CART_KEY, JSON.stringify(cart));
        updateCartBadge();
    } catch (e) {
        console.error('Erreur sauvegarde cart:', e);
    }
}

// Mettre à jour le badge dans le Header (si panier LocalStorage actif)
function updateCartBadge() {
    const cart = getCart();
    if (cart.length > 0) {
        const totalItems = cart.reduce((sum, item) => sum + parseInt(item.quantity || 1), 0);
        
        const badgeElements = document.querySelectorAll('.cart-badge-count');
        badgeElements.forEach(el => {
            el.textContent = totalItems;
        });

        const isEn = (localStorage.getItem('tpm_site_lang') === 'en');
        const cartTextElements = document.querySelectorAll('.cart-button-label, .cart-button-text');
        cartTextElements.forEach(el => {
            el.innerHTML = isEn ? `My Pro-Forma Quote (<span class="cart-badge-count">${totalItems}</span>)` : `Mon Panier Pro-Forma (<span class="cart-badge-count">${totalItems}</span>)`;
        });
    }
}

// Ajouter un produit au panier
function addToCart(product) {
    let cart = getCart();
    
    // Identifiant unique basé sur ID + couleur + longueur
    const itemKey = `${product.id}-${product.color || 'default'}-${product.length || 'default'}`;
    const existingIndex = cart.findIndex(item => item.itemKey === itemKey);
    
    if (existingIndex > -1) {
        cart[existingIndex].quantity = parseInt(cart[existingIndex].quantity) + parseInt(product.quantity || 1);
    } else {
        cart.push({
            itemKey: itemKey,
            id: product.id,
            code: product.code || 'TPM-REF',
            name: product.name,
            price_ht: parseFloat(product.price_ht),
            unit: product.unit || 'unité',
            color: product.color || 'Standard',
            length: product.length || 'Standard',
            quantity: parseInt(product.quantity || 1),
            image: product.image || ''
        });
    }
    
    saveCart(cart);
    showToast(`"${product.name}" ajouté à votre Panier Pro-Forma !`);
}

// Supprimer un élément du panier
function removeFromCart(index) {
    let cart = getCart();
    if (index >= 0 && index < cart.length) {
        const removed = cart.splice(index, 1);
        saveCart(cart);
        if (typeof renderProformaCart === 'function') {
            renderProformaCart();
        }
        showToast(`Article supprimé du panier pro-forma.`, 'info');
    }
}

// Mettre à jour la quantité d'un article
function updateCartQuantity(index, newQty) {
    let cart = getCart();
    newQty = parseInt(newQty);
    if (index >= 0 && index < cart.length) {
        if (newQty <= 0) {
            removeFromCart(index);
        } else {
            cart[index].quantity = newQty;
            saveCart(cart);
            if (typeof renderProformaCart === 'function') {
                renderProformaCart();
            }
        }
    }
}

// Vider le panier
function clearCart() {
    localStorage.removeItem(TPM_CART_KEY);
    updateCartBadge();
    if (typeof renderProformaCart === 'function') {
        renderProformaCart();
    }
    showToast('Panier Pro-Forma réinitialisé.', 'info');
}

// Formatage Monétaire en FCFA (XAF)
function formatMoney(amount) {
    return new Intl.NumberFormat('fr-FR', {
        style: 'decimal',
        maximumFractionDigits: 0
    }).format(amount) + ' XAF';
}

// Notification Toast
function showToast(message, type = 'success') {
    let container = document.getElementById('tpm-toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'tpm-toast-container';
        container.className = 'fixed bottom-5 right-5 z-50 flex flex-col gap-2 max-w-md pointer-events-none';
        document.body.appendChild(container);
    }
    
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-[#1C1340]' : 'bg-[#D84B1F]';
    const borderColor = type === 'success' ? 'border-[#D84B1F]' : 'border-white';
    
    toast.className = `${bgColor} text-white px-5 py-4 rounded-md border-l-4 ${borderColor} shadow-2xl flex items-center gap-3 transition-all duration-300 transform translate-y-4 opacity-0 pointer-events-auto`;
    toast.innerHTML = `
        <span class="material-symbols-outlined text-[#D84B1F]">${type === 'success' ? 'check_circle' : 'info'}</span>
        <div class="flex-grow font-medium text-sm">${message}</div>
        <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-white">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    `;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.remove('translate-y-4', 'opacity-0');
    }, 10);
    
    setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-4');
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}

// Initialisation globale au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    updateCartBadge();
});
