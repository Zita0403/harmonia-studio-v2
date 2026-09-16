export default {
  extends: ["html-validate:recommended"],
  transform: {
    "^.*\\.php$": "./transform-php.js"
  },
  rules: {
    "doctype-first": "off",
    "close-order": "off",
    "no-inline-style": "off",
    "no-trailing-whitespace": "off",
    "prefer-button": "off",
    "empty-title": "off",
    "empty-heading": "off",             // PHP dynamic headings
    "form-dup-name": "off",       
    "no-implicit-close": "off",        // Header/Footer partials (<html>, <body>)
    "attribute-allowed-values": "off", // Empty action="" or href="" from PHP vars
    "wcag/h30": "off",                 // Dynamic PHP link text or icon links
    "no-implicit-button-type": "warn",
    "wcag/h63": "error"
  }
};