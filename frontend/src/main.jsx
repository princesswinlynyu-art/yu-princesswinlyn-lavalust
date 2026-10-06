import React, { useEffect, useState } from 'react';
import { createRoot } from 'react-dom/client';
import './style.css';

const API = (import.meta.env.VITE_API_BASE_URL || 'http://127.0.0.1:3000/api').replace(/\/$/, '');
const TOKEN_KEY = 'lavalust_access_token';

async function request(path, { token, ...options } = {}) {
  const response = await fetch(`${API}${path}`, {
    ...options,
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
      ...(token ? { Authorization: `Bearer ${token}` } : {}),
      ...options.headers,
    },
  });
  const result = await response.json().catch(() => ({}));
  if (!response.ok) throw new Error(result.error || result.message || `Request failed (${response.status})`);
  return result;
}

function App() {
  const [token, setToken] = useState(() => localStorage.getItem(TOKEN_KEY) || '');
  const [user, setUser] = useState(() => {
    try { return JSON.parse(localStorage.getItem('lavalust_user') || 'null'); } catch { return null; }
  });
  const [products, setProducts] = useState([]);
  const [mode, setMode] = useState('login');
  const [busy, setBusy] = useState(false);
  const [notice, setNotice] = useState(null);
  const [editing, setEditing] = useState(null);
  const [auth, setAuth] = useState({ fullname: '', username: '', password: '' });
  const [form, setForm] = useState({ product_name: '', description: '', price: '', quantity: '0' });

  async function loadProducts(activeToken = token) {
    const result = await request('/products', { token: activeToken });
    setProducts(result.data || []);
  }

  useEffect(() => {
    if (!token) return;
    loadProducts().catch((error) => {
      if (/token|unauthorized|expired/i.test(error.message)) logout();
      setNotice({ type: 'error', text: error.message });
    });
  }, [token]);

  async function submitAuth(event) {
    event.preventDefault();
    setBusy(true);
    setNotice(null);
    try {
      const result = await request(mode === 'login' ? '/login' : '/register', {
        method: 'POST',
        body: JSON.stringify(auth),
      });
      if (mode === 'register') {
        setMode('login');
        setAuth({ fullname: '', username: auth.username, password: '' });
        setNotice({ type: 'success', text: 'Account created. Sign in with your new account.' });
      } else {
        localStorage.setItem(TOKEN_KEY, result.token);
        localStorage.setItem('lavalust_user', JSON.stringify(result.user));
        setToken(result.token);
        setUser(result.user);
        setAuth({ fullname: '', username: '', password: '' });
        setNotice({ type: 'success', text: 'You are signed in.' });
      }
    } catch (error) {
      setNotice({ type: 'error', text: error.message });
    } finally {
      setBusy(false);
    }
  }

  function logout() {
    localStorage.removeItem(TOKEN_KEY);
    localStorage.removeItem('lavalust_user');
    setToken('');
    setUser(null);
    setProducts([]);
    setEditing(null);
    setNotice(null);
  }

  async function saveProduct(event) {
    event.preventDefault();
    setBusy(true);
    setNotice(null);
    const payload = {
      ...form,
      product_name: form.product_name.trim(),
      description: form.description.trim(),
      price: Number(form.price),
      quantity: Number(form.quantity),
    };
    try {
      await request(editing ? `/products/${editing}` : '/products', {
        method: editing ? 'PUT' : 'POST',
        token,
        body: JSON.stringify(payload),
      });
      setForm({ product_name: '', description: '', price: '', quantity: '0' });
      setEditing(null);
      await loadProducts();
      setNotice({ type: 'success', text: editing ? 'Product updated.' : 'Product added.' });
    } catch (error) {
      setNotice({ type: 'error', text: error.message });
    } finally {
      setBusy(false);
    }
  }

  function editProduct(product) {
    setEditing(product.id);
    setForm({
      product_name: product.product_name || '',
      description: product.description || '',
      price: String(product.price ?? ''),
      quantity: String(product.quantity ?? 0),
    });
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  async function deleteProduct(product) {
    if (!window.confirm(`Delete “${product.product_name}”? This cannot be undone.`)) return;
    setBusy(true);
    setNotice(null);
    try {
      await request(`/products/${product.id}`, { method: 'DELETE', token });
      await loadProducts();
      setNotice({ type: 'success', text: 'Product deleted.' });
    } catch (error) {
      setNotice({ type: 'error', text: error.message });
    } finally {
      setBusy(false);
    }
  }

  const totalValue = products.reduce((sum, product) => sum + Number(product.price) * Number(product.quantity), 0);

  return (
    <main className="shell">
      <header className="topbar">
        <a className="brand" href="/" aria-label="Fieldnotes home"><span className="brand-mark">F</span><span>fieldnotes<span className="brand-dot">.</span></span></a>
        <span className="topbar-note">INVENTORY / 01</span>
        {token && <button className="text-button" onClick={logout}>Sign out <span aria-hidden="true">↗</span></button>}
      </header>

      {!token ? (
        <section className="auth-layout">
          <div className="auth-intro">
            <p className="eyebrow">A LITTLE MORE IN ORDER</p>
            <h1>Keep good<br />things <em>moving.</em></h1>
            <p className="intro-copy">A calm place to keep track of your products, stock, and the details that matter.</p>
            <div className="auth-stamp"><span className="stamp-star">✳</span><span>PRODUCTS<br />& INVENTORY</span><span className="stamp-year">EST. 2026</span></div>
          </div>
          <section className="auth-card">
            <p className="eyebrow">{mode === 'login' ? 'WELCOME BACK' : 'GET STARTED'}</p>
            <h2>{mode === 'login' ? 'Sign in' : 'Create your account'}</h2>
            <p className="muted">{mode === 'login' ? 'Your inventory is right where you left it.' : 'Set up an account to manage your inventory.'}</p>
            {notice && <p className={`notice ${notice.type}`} role="status">{notice.text}</p>}
            <form className="stack-form" onSubmit={submitAuth}>
              {mode === 'register' && <label>Full name<input value={auth.fullname} onChange={(e) => setAuth({ ...auth, fullname: e.target.value })} autoComplete="name" required /></label>}
              <label>Username<input value={auth.username} onChange={(e) => setAuth({ ...auth, username: e.target.value })} autoComplete="username" minLength="3" maxLength="50" required /></label>
              <label>Password<input type="password" value={auth.password} onChange={(e) => setAuth({ ...auth, password: e.target.value })} autoComplete={mode === 'login' ? 'current-password' : 'new-password'} minLength={mode === 'register' ? 8 : undefined} required /></label>
              <button className="button primary full" disabled={busy}>{busy ? 'Please wait…' : mode === 'login' ? 'Sign in' : 'Create account'} <span aria-hidden="true">↗</span></button>
            </form>
            <p className="switch-mode">{mode === 'login' ? 'New around here?' : 'Already have an account?'} <button className="inline-button" onClick={() => { setMode(mode === 'login' ? 'register' : 'login'); setNotice(null); }}>{mode === 'login' ? 'Create an account' : 'Sign in'}</button></p>
            <p className="api-caption">SECURED BY LAVALUST API <span>•</span> REACT FRONTEND</p>
          </section>
        </section>
      ) : (
        <>
          <section className="page-heading">
            <div><p className="eyebrow">YOUR WORKSPACE / {new Date().getFullYear()}</p><h1>Product <em>inventory.</em></h1><p className="intro-copy">A clear view of what you have and what’s next.</p></div>
            <div className="heading-greeting"><span className="avatar">{(user?.username || 'U').slice(0, 1).toUpperCase()}</span><span>Signed in as<br /><strong>{user?.username || 'you'}</strong></span></div>
          </section>
          {notice && <p className={`notice ${notice.type}`} role="status">{notice.text}</p>}
          <section className="summary-grid" aria-label="Inventory summary">
            <article className="summary-card"><span>PRODUCTS</span><strong>{products.length.toString().padStart(2, '0')}</strong><small>items in your catalogue</small></article>
            <article className="summary-card"><span>UNITS ON HAND</span><strong>{products.reduce((sum, item) => sum + Number(item.quantity), 0).toLocaleString()}</strong><small>across all products</small></article>
            <article className="summary-card accent-card"><span>STOCK VALUE</span><strong>${totalValue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</strong><small>based on current quantity</small></article>
          </section>
          <section className="workspace-grid">
            <section className="panel product-panel">
              <div className="panel-heading"><div><p className="eyebrow">THE CATALOGUE</p><h2>Products <span className="count-pill">{products.length}</span></h2></div><span className="panel-mark">✳</span></div>
              {products.length === 0 ? <div className="empty-state"><span>✳</span><h3>A fresh start.</h3><p>Add your first product and it’ll show up here.</p></div> : <div className="table-wrap"><table><thead><tr><th>PRODUCT</th><th>PRICE</th><th>IN STOCK</th><th>ADDED</th><th><span className="sr-only">Actions</span></th></tr></thead><tbody>{products.map((product) => <tr key={product.id}><td><strong>{product.product_name}</strong><small>{product.description || 'No description'}</small></td><td>${Number(product.price).toFixed(2)}</td><td><span className={`stock ${Number(product.quantity) === 0 ? 'out' : ''}`}>{Number(product.quantity)} units</span></td><td>{product.created_at ? new Date(product.created_at).toLocaleDateString() : '—'}</td><td className="actions"><button aria-label={`Edit ${product.product_name}`} onClick={() => editProduct(product)}>Edit</button><button aria-label={`Delete ${product.product_name}`} onClick={() => deleteProduct(product)}>Delete</button></td></tr>)}</tbody></table></div>}
              <div className="table-footer"><span>SHOWING {products.length} {products.length === 1 ? 'PRODUCT' : 'PRODUCTS'}</span><button className="refresh-button" onClick={() => loadProducts().catch((error) => setNotice({ type: 'error', text: error.message }))}>↻ Refresh list</button></div>
            </section>
            <aside className="panel form-panel">
              <div className="panel-heading"><div><p className="eyebrow">{editing ? 'MAKE A CHANGE' : 'GROW YOUR CATALOGUE'}</p><h2>{editing ? 'Edit product' : 'Add a product'}</h2></div><span className="form-index">{editing ? '02' : '01'}</span></div>
              <form className="stack-form" onSubmit={saveProduct}>
                <label>Product name<input maxLength="100" value={form.product_name} onChange={(e) => setForm({ ...form, product_name: e.target.value })} placeholder="e.g. Studio mug" required /></label>
                <label>Description <span className="optional">OPTIONAL</span><textarea rows="3" value={form.description} onChange={(e) => setForm({ ...form, description: e.target.value })} placeholder="A few words about it…" /></label>
                <div className="field-row"><label>Price<input type="number" min="0" step="0.01" value={form.price} onChange={(e) => setForm({ ...form, price: e.target.value })} placeholder="0.00" required /></label><label>Quantity<input type="number" min="0" step="1" value={form.quantity} onChange={(e) => setForm({ ...form, quantity: e.target.value })} required /></label></div>
                <button className="button primary full" disabled={busy}>{busy ? 'Saving…' : editing ? 'Save changes' : 'Add to inventory'} <span aria-hidden="true">↗</span></button>
                {editing && <button className="button quiet full" type="button" onClick={() => { setEditing(null); setForm({ product_name: '', description: '', price: '', quantity: '0' }); }}>Cancel editing</button>}
              </form>
              <p className="form-footnote"><span>✳</span> Your changes are saved securely to the database.</p>
            </aside>
          </section>
        </>
      )}
      <footer className="footer"><span>FIELDNOTES INVENTORY</span><span>MADE TO KEEP THINGS IN MOTION <i>✳</i></span><span>LAVALUST × REACT</span></footer>
    </main>
  );
}

createRoot(document.getElementById('root')).render(<App />);
