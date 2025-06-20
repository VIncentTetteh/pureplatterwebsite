# 🚀 Quick Start Guide

## Fix: Website Showing Raw HTML

The issue is that you're opening the HTML file directly in the browser (`file://` protocol). Modern browsers block external resources (CSS, JS) for security when loading local files.

**Solution: Run a local web server**

## 🛠️ Option 1: Automatic Server (Recommended)

```bash
# Make the script executable and run it
chmod +x start-server.sh
./start-server.sh
```

Then open: **http://localhost:8000**

---

## 🐍 Option 2: Python Server (Most Common)

### Python 3:
```bash
python3 -m http.server 8000
```

### Python 2:
```bash
python -m SimpleHTTPServer 8000
```

Then open: **http://localhost:8000**

---

## 🐘 Option 3: PHP Server

```bash
php -S localhost:8000
```

Then open: **http://localhost:8000**

---

## 🟢 Option 4: Node.js Server

```bash
# Install http-server globally
npm install -g http-server

# Start server
http-server -p 8000
```

Then open: **http://localhost:8000**

---

## ✅ What You Should See:

1. **Beautiful Design**: Rice-themed golden colors
2. **Responsive Layout**: Works on mobile and desktop
3. **Working Navigation**: Smooth scrolling between sections
4. **Shopping Cart**: Functional add to cart buttons
5. **WhatsApp Button**: Green floating button (bottom right)
6. **Contact Form**: Professional contact section

---

## 🔧 Troubleshooting:

### Still seeing raw HTML?
- Make sure you're accessing `http://localhost:8000` (not `file://`)
- Clear your browser cache (Cmd+Shift+R on Mac)
- Try a different browser

### Can't access localhost?
- Check if the server is running (should show "Serving at...")
- Try a different port: add `:8001` instead of `:8000`
- Make sure no other applications are using port 8000

### CSS not loading?
- Check browser console for errors (F12 → Console)
- Verify internet connection (CDN resources need internet)
- Try disabling browser extensions

---

## 📱 Test on Mobile:

1. Start the server as above
2. Find your computer's IP address:
   ```bash
   ipconfig getifaddr en0
   ```
3. On your phone, go to: `http://YOUR_IP:8000`
   (e.g., `http://192.168.1.100:8000`)

---

## 🎯 Next Steps:

1. **Test Shopping Cart**: Add rice packages to cart
2. **Test Contact Form**: Send a test message
3. **Test WhatsApp**: Click the green button
4. **Test Paystack**: Try the checkout (use test mode)

---

**Need help? Contact: vincentchrisbone@gmail.com**

