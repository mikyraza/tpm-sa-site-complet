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
function showToast(message, type = 'success', actionUrl = null, actionText = 'Voir la Pro-Forma →') {
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
    
    const actionBtn = actionUrl ? `<a href="${actionUrl}" class="inline-block mt-1.5 text-xs font-black text-tpm-orange hover:underline uppercase tracking-wider">${actionText}</a>` : '';

    toast.className = `${bgColor} text-white px-5 py-4 rounded-xl border-l-4 ${borderColor} shadow-2xl flex items-start gap-3 transition-all duration-300 transform translate-y-4 opacity-0 pointer-events-auto border border-white/10`;
    toast.innerHTML = `
        <span class="material-symbols-outlined text-[#D84B1F] text-[22px] shrink-0 mt-0.5">${type === 'success' ? 'check_circle' : 'info'}</span>
        <div class="flex-grow font-medium text-xs sm:text-sm leading-relaxed">
            <div>${message}</div>
            ${actionBtn}
        </div>
        <button onclick="this.closest('.pointer-events-auto').remove()" class="text-gray-400 hover:text-white shrink-0 ml-1">
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
    }, 5000);
}

/**
 * FAST AJAX ADD TO CART / PRO-FORMA (NO PAGE RELOAD / NO SCROLL TO TOP)
 */
function initAjaxAddToCart() {
    // 1. Intercept plain <a> add-to-cart clicks (e.g. ?add-to-cart=16)
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a[href*="add-to-cart="]');
        if (!link) return;

        // Don't intercept if it's an external link or has special target
        if (link.target === '_blank') return;

        e.preventDefault();
        e.stopPropagation();

        const href = link.getAttribute('href');
        const urlParams = new URLSearchParams(href.split('?')[1] || '');
        const productId = urlParams.get('add-to-cart');
        const quantity = urlParams.get('quantity') || 1;
        const flashLength = urlParams.get('flash_length') || urlParams.get('flash-length') || '';
        const flashColor = urlParams.get('flash_color') || urlParams.get('flash-color') || '';

        if (!productId) return;

        performAjaxAddToCart(link, {
            product_id: productId,
            quantity: quantity,
            flash_length: flashLength,
            flash_color: flashColor
        });
    });

    // 2. Intercept Flash Pro-Forma and Single Product Forms
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (!form) return;

        const isFlashForm = (form.id === 'flash-proforma-form');
        const isSingleProductForm = form.classList.contains('cart') || form.querySelector('button[name="add-to-cart"]');

        if (isFlashForm || isSingleProductForm) {
            e.preventDefault();
            e.stopPropagation();

            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]') || form.querySelector('button[name="add-to-cart"]');
            
            let productId = formData.get('add-to-cart');
            if (!productId && submitBtn) {
                productId = submitBtn.value || submitBtn.getAttribute('value');
            }

            const quantity = formData.get('quantity') || 1;
            const flashLength = formData.get('flash_length') || formData.get('flash-length') || '';
            const flashColor = formData.get('flash_color') || formData.get('flash-color') || '';

            if (!productId) return;

            performAjaxAddToCart(submitBtn || form, {
                product_id: productId,
                quantity: quantity,
                flash_length: flashLength,
                flash_color: flashColor
            });
        }
    });
}

/**
 * Execute AJAX request to WordPress/WooCommerce backend
 */
function performAjaxAddToCart(triggerElement, data) {
    if (!triggerElement) return;

    const originalHtml = triggerElement.innerHTML;
    const isButton = (triggerElement.tagName === 'BUTTON' || triggerElement.tagName === 'A');

    // Visual feedback: Loading state
    if (isButton) {
        triggerElement.style.pointerEvents = 'none';
        triggerElement.innerHTML = `
            <span class="material-symbols-outlined text-[15px] animate-spin">sync</span>
            <span>Ajout...</span>
        `;
    }

    const ajaxUrl = (typeof tpm_ajax !== 'undefined' && tpm_ajax.ajax_url) ? tpm_ajax.ajax_url : '/wp-admin/admin-ajax.php';
    const cartUrl = (typeof tpm_ajax !== 'undefined' && tpm_ajax.cart_url) ? tpm_ajax.cart_url : '/cart/';

    const bodyData = new URLSearchParams();
    bodyData.append('action', 'tpm_ajax_add_to_cart');
    bodyData.append('product_id', data.product_id);
    bodyData.append('quantity', data.quantity);
    if (data.flash_length) bodyData.append('flash_length', data.flash_length);
    if (data.flash_color) bodyData.append('flash_color', data.flash_color);

    fetch(ajaxUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: bodyData.toString()
    })
    .then(response => response.json())
    .then(res => {
        if (res && res.success) {
            // Update Header Badges
            const newCount = res.data.count || 1;
            document.querySelectorAll('.cart-badge-count').forEach(el => {
                el.textContent = newCount;
            });

            const isEn = (localStorage.getItem('tpm_site_lang') === 'en');
            document.querySelectorAll('.cart-button-label, .cart-button-text').forEach(el => {
                el.innerHTML = isEn ? `My Pro-Forma Quote (<span class="cart-badge-count">${newCount}</span>)` : `Mon Panier Pro-Forma (<span class="cart-badge-count">${newCount}</span>)`;
            });

            // Success feedback on button
            if (isButton) {
                triggerElement.innerHTML = `
                    <span class="material-symbols-outlined text-[15px] text-emerald-300">check_circle</span>
                    <span class="text-emerald-200 font-black">Ajouté ✓</span>
                `;
            }

            // Toast notification
            const successMsg = isEn ? `"${res.data.product_name}" added to your Pro-Forma Quote!` : `"${res.data.product_name}" ajouté à votre Pro-Forma !`;
            const ctaMsg = isEn ? 'View Pro-Forma Quote →' : 'Voir ma Pro-Forma →';
            showToast(successMsg, 'success', cartUrl, ctaMsg);

            // Revert button text after 1.8s
            setTimeout(() => {
                if (isButton) {
                    triggerElement.innerHTML = originalHtml;
                    triggerElement.style.pointerEvents = 'auto';
                }
            }, 1800);

        } else {
            const errorMsg = (res && res.data && res.data.message) ? res.data.message : 'Erreur lors de l\'ajout au panier.';
            showToast(errorMsg, 'error');
            if (isButton) {
                triggerElement.innerHTML = originalHtml;
                triggerElement.style.pointerEvents = 'auto';
            }
        }
    })
    .catch(err => {
        console.error('AJAX add to cart error:', err);
        showToast('Erreur de connexion lors de l\'ajout.', 'error');
        if (isButton) {
            triggerElement.innerHTML = originalHtml;
            triggerElement.style.pointerEvents = 'auto';
        }
    });
}

// Initialisation globale au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    updateCartBadge();
    initAjaxAddToCart();
});

