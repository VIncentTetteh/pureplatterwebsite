#!/bin/bash

# PureGrain Rice Website - Local Development Server
# This script starts a local web server for development

echo "🌾 Starting PureGrain Rice Website Development Server..."
echo "======================================================"

# Check if Python 3 is available
if command -v python3 &> /dev/null; then
    echo "✅ Using Python 3 server"
    echo "🌐 Starting server at: http://localhost:8000"
    echo "📱 Mobile access: http://$(ipconfig getifaddr en0):8000"
    echo ""
    echo "Press Ctrl+C to stop the server"
    echo "======================================================"
    python3 -m http.server 8000
    
# Check if Python 2 is available
elif command -v python &> /dev/null; then
    echo "✅ Using Python 2 server"
    echo "🌐 Starting server at: http://localhost:8000"
    echo "📱 Mobile access: http://$(ipconfig getifaddr en0):8000"
    echo ""
    echo "Press Ctrl+C to stop the server"
    echo "======================================================"
    python -m SimpleHTTPServer 8000
    
# Check if PHP is available
elif command -v php &> /dev/null; then
    echo "✅ Using PHP built-in server"
    echo "🌐 Starting server at: http://localhost:8000"
    echo "📱 Mobile access: http://$(ipconfig getifaddr en0):8000"
    echo ""
    echo "Press Ctrl+C to stop the server"
    echo "======================================================"
    php -S localhost:8000
    
# Check if Node.js is available
elif command -v node &> /dev/null; then
    echo "✅ Installing and using http-server (Node.js)"
    npm install -g http-server 2>/dev/null
    echo "🌐 Starting server at: http://localhost:8000"
    echo "📱 Mobile access: http://$(ipconfig getifaddr en0):8000"
    echo ""
    echo "Press Ctrl+C to stop the server"
    echo "======================================================"
    http-server -p 8000
    
else
    echo "❌ No suitable server found!"
    echo ""
    echo "Please install one of the following:"
    echo "  • Python 3: brew install python3"
    echo "  • PHP: brew install php"
    echo "  • Node.js: brew install node"
    echo ""
    echo "Then run this script again."
    exit 1
fi

