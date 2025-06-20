# PureGrain Rice Website

A premium one-page e-commerce website for PureGrain Rice by PurePlatter Foods LTD, featuring modern design, shopping cart functionality, and integrated payment processing.

## 🌾 Features

### Design & User Experience
- **Responsive Design**: Mobile-first design that looks great on all devices
- **Modern UI**: Clean, professional design with rice-themed colors
- **Smooth Animations**: Scroll-triggered animations and smooth transitions
- **Interactive Elements**: Hover effects and animated components

### E-commerce Functionality
- **Shopping Cart**: Add products, update quantities, remove items
- **Multiple Products**: 5KG, 10KG, and 25KG rice packages
- **Real-time Cart Updates**: Live cart count and total calculation
- **Product Notifications**: Success messages when items are added

### Payment Integration
- **Paystack Integration**: Secure payment processing for Ghana
- **Multiple Payment Methods**: Cards, mobile money, bank transfer
- **Order Management**: Automatic order reference generation

### Communication Features
- **Contact Form**: Direct email integration to vincentchrisbone@gmail.com
- **WhatsApp Integration**: Floating WhatsApp button for instant messaging
- **Email Notifications**: Server-side email sending capability

## 🚀 Quick Start

1. **Open the website**:
   ```bash
   cd puregrain-rice-website
   open index.html  # On macOS
   # or double-click index.html in your file explorer
   ```

2. **For email functionality**, you'll need a web server:
   ```bash
   # Using Python (if you have Python installed)
   python -m http.server 8000
   # Then visit http://localhost:8000
   
   # Or using PHP (if you have PHP installed)
   php -S localhost:8000
   # Then visit http://localhost:8000
   ```

## ⚙️ Configuration

### Paystack Setup
1. Sign up at [Paystack](https://paystack.com/)
2. Get your public key from the dashboard
3. Replace `'pk_test_YOUR_PUBLIC_KEY_HERE'` in `index.html` with your actual public key

### Email Configuration
1. **Basic Setup**: The current setup uses PHP's mail() function
2. **Africa's Talking Integration**: 
   - Sign up at [Africa's Talking](https://africastalking.com/)
   - Get your API key and username
   - Update the credentials in `send-email.php`
   - Uncomment the Africa's Talking code section

### WhatsApp Configuration
- The WhatsApp button is already configured for +233542880528
- To change the number, edit the `href` attribute in the WhatsApp button section

## 📱 Sections Overview

1. **Hero Section**: Eye-catching banner with call-to-action buttons
2. **About Section**: Company information and location details
3. **Products Section**: Features and benefits of PureGrain Rice
4. **Benefits Section**: 6 key advantages of choosing PureGrain Rice
5. **Shop Section**: Product catalog with pricing and cart functionality
6. **Contact Section**: Contact form and business information
7. **Footer**: Quick links and additional contact details

## 🛒 How to Use the Shopping Cart

1. **Add Items**: Click "Add to Cart" on any product
2. **View Cart**: Click the cart icon in the navigation
3. **Manage Items**: Increase/decrease quantities or remove items
4. **Checkout**: Click "Proceed to Checkout" for Paystack payment
5. **Payment**: Complete payment through Paystack's secure interface

## 📞 Contact Methods

- **Email**: Contact form sends emails to vincentchrisbone@gmail.com
- **WhatsApp**: Floating button connects to +233542880528
- **Address**: Taifa Suma Ampim 23, Ghana

## 🎨 Color Scheme

- **Rice Gold**: #D4AF37 (Primary brand color)
- **Rice Cream**: #F5F5DC (Background color)
- **Ghana Red**: #CE1126 (Accent color)
- **Ghana Green**: #006B3F (Success/nature color)
- **Ghana Gold**: #FCD116 (Secondary accent)

## 📦 File Structure

```
puregrain-rice-website/
├── index.html          # Main website file
├── send-email.php      # Server-side email handler
└── README.md          # This file
```

## 🔧 Technical Requirements

- **Modern Web Browser**: Chrome, Firefox, Safari, Edge
- **Web Server**: Required for email functionality (PHP support recommended)
- **Internet Connection**: For CDN resources and payment processing

## 🚨 Important Notes

1. **Paystack Public Key**: Remember to replace the test key with your actual public key
2. **Email Server**: For production use, configure a proper email server or use Africa's Talking
3. **SSL Certificate**: For production, ensure you have an SSL certificate for secure payments
4. **Mobile Testing**: Test the website on various mobile devices for optimal user experience

## 📈 Future Enhancements

- User account system
- Order history and tracking
- Inventory management
- Customer reviews and ratings
- Multi-language support
- Advanced analytics

## 🔐 Security Considerations

- All form inputs are validated and sanitized
- Payment processing is handled securely through Paystack
- Email sending includes protection against injection attacks
- CORS headers are properly configured

## 📞 Support

For technical support or questions about the website:
- WhatsApp: +233542880528
- Email: vincentchrisbone@gmail.com

---

**Made with ❤️ in Ghana for PurePlatter Foods LTD**

