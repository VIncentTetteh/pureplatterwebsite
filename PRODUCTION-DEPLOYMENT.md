# 🚀 Production Deployment Guide

## PureGrain Rice Website - Production Ready Setup

This guide will help you deploy the PureGrain Rice website securely in a production environment.

## 🔐 Security Features Implemented

### Frontend Security
- ✅ **Content Security Policy (CSP)** - Prevents XSS attacks
- ✅ **Subresource Integrity (SRI)** - Validates CDN resources
- ✅ **HTTPS Enforcement** - Secure communication
- ✅ **Input Validation** - Client-side form validation
- ✅ **No inline secrets** - API keys handled securely

### Backend Security
- ✅ **Rate Limiting** - Prevents spam and abuse (5 emails/hour/session)
- ✅ **Input Sanitization** - HTML encoding and validation
- ✅ **Spam Detection** - Basic keyword filtering
- ✅ **CORS Protection** - Restricted origins
- ✅ **HTTP Security Headers** - X-Frame-Options, X-XSS-Protection, etc.
- ✅ **File Access Protection** - Hidden config files
- ✅ **Session Security** - Secure session handling

### Payment Security
- ✅ **Paystack Integration** - PCI-compliant payment processing
- ✅ **No stored payment data** - All handled by Paystack
- ✅ **Environment-based keys** - Test/live key separation
- ✅ **Transaction validation** - Secure reference generation

## 📋 Pre-Deployment Checklist

### 1. Domain & Hosting
- [ ] Purchase domain name (e.g., pureplatterfoods.com)
- [ ] Set up web hosting with PHP 7.4+ support
- [ ] Configure SSL certificate (Let's Encrypt recommended)
- [ ] Ensure mod_rewrite is enabled

### 2. Paystack Setup
- [ ] Create Paystack account at [paystack.com](https://paystack.com)
- [ ] Complete business verification
- [ ] Get test and live API keys
- [ ] Test payments in test mode
- [ ] Switch to live mode for production

### 3. Email Configuration
- [ ] Set up business email (info@pureplatterfoods.com)
- [ ] Configure SMTP or use Africa's Talking Email API
- [ ] Test email delivery
- [ ] Set up email forwarding to vincentchrisbone@gmail.com

## 🛠️ Deployment Steps

### Step 1: Upload Files
```bash
# Upload these files to your web server:
├── index.html
├── send-email.php
├── config.php
├── .htaccess
└── README.md
```

### Step 2: Configure Settings

1. **Update config.php**:
```php
// Replace with your actual values
define('PAYSTACK_PUBLIC_KEY_LIVE', 'pk_live_your_actual_key');
define('PAYSTACK_SECRET_KEY_LIVE', 'sk_live_your_actual_secret');
define('AFRICAS_TALKING_API_KEY', 'your_api_key');
```

2. **Update CORS origins in send-email.php**:
```php
header('Access-Control-Allow-Origin: https://pureplatterfoods.com');
```

3. **Enable HTTPS redirect in .htaccess**:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### Step 3: Test Everything

1. **Test Contact Form**:
   - Submit a test message
   - Verify email delivery to vincentchrisbone@gmail.com
   - Check rate limiting (try sending 6 emails quickly)

2. **Test Shopping Cart**:
   - Add products to cart
   - Test quantity updates
   - Test item removal

3. **Test Paystack Integration**:
   - Use test cards in test mode
   - Verify successful payment flow
   - Check webhook delivery (if configured)

4. **Test WhatsApp Integration**:
   - Click WhatsApp button
   - Verify correct number (+233542880528)
   - Test message pre-fill

### Step 4: Go Live

1. **Switch to Production Mode**:
   - Update `config.php`: `define('ENVIRONMENT', 'production');`
   - Use live Paystack keys
   - Test with small real transaction

2. **Monitor & Maintain**:
   - Check error logs regularly
   - Monitor payment transactions
   - Update security headers as needed

## 🔧 Environment Variables (Alternative)

For enhanced security, you can use environment variables instead of config.php:

```bash
# Add to your server environment
export PAYSTACK_PUBLIC_KEY="pk_live_your_key"
export PAYSTACK_SECRET_KEY="sk_live_your_secret"
export AFRICAS_TALKING_API_KEY="your_api_key"
export RECIPIENT_EMAIL="vincentchrisbone@gmail.com"
```

Then modify send-email.php to use `$_ENV` variables.

## 🚨 Security Recommendations

### Essential
1. **Always use HTTPS** - Never deploy without SSL
2. **Keep software updated** - PHP, web server, etc.
3. **Regular backups** - Daily automated backups
4. **Monitor logs** - Watch for suspicious activity
5. **Strong passwords** - Use 2FA where possible

### Optional Enhancements
1. **Web Application Firewall (WAF)** - Cloudflare or similar
2. **DDoS Protection** - Cloudflare Pro
3. **Uptime Monitoring** - UptimeRobot or Pingdom
4. **Performance Monitoring** - Google PageSpeed Insights
5. **Database** - Add MySQL for order storage

## 📊 Performance Optimization

### Already Implemented
- ✅ Gzip compression
- ✅ Browser caching
- ✅ CDN usage (Tailwind, FontAwesome)
- ✅ Minified resources
- ✅ Preconnect hints

### Additional Optimizations
- **Image optimization** - WebP format, compression
- **Lazy loading** - For images below the fold
- **Service Worker** - For offline capability
- **Critical CSS** - Inline critical styles

## 🐛 Troubleshooting

### Common Issues

1. **Paystack "Invalid Key" Error**:
   - Verify key format (pk_live_ or pk_test_)
   - Check for extra spaces or characters
   - Ensure key matches environment

2. **Email Not Sending**:
   - Check PHP mail configuration
   - Verify SMTP settings
   - Check spam folders
   - Try Africa's Talking API

3. **CORS Errors**:
   - Update allowed origins
   - Check HTTPS vs HTTP
   - Verify domain spelling

4. **Rate Limiting Issues**:
   - Clear browser cookies
   - Adjust limits in config
   - Check session configuration

### Log Files to Monitor
```bash
# Check these logs regularly
/var/log/apache2/error.log
/var/log/apache2/access.log
/var/log/php_errors.log
```

## 📞 Support & Maintenance

### Regular Tasks
- **Weekly**: Check email delivery
- **Monthly**: Review payment transactions
- **Quarterly**: Update dependencies
- **Yearly**: Renew SSL certificates

### Emergency Contacts
- **Technical Issues**: vincentchrisbone@gmail.com
- **Payment Issues**: Paystack Support
- **Hosting Issues**: Your hosting provider

## 🎯 Success Metrics

Monitor these KPIs:
- **Conversion Rate**: Visitors to purchases
- **Cart Abandonment**: Items added vs purchased
- **Contact Form**: Submissions and responses
- **Page Load Speed**: < 3 seconds target
- **Uptime**: 99.9% target

---

**✅ Website is now production-ready and secure!**

For technical support: vincentchrisbone@gmail.com
For business inquiries: +233542880528 (WhatsApp)

