const fs = require('fs');
const path = require('path');

const srcDir = 'c:/Users/hirai/Desktop/zoopi/src/pages';
const files = fs.readdirSync(srcDir)
  .filter(f => f.endsWith('.html'))
  .map(f => path.join(srcDir, f));

files.forEach(file => {
  let content = fs.readFileSync(file, 'utf8');
  
  const replacement = `<section class="payment-icons" style="gap: 5px;">
            <img src="/src/assets/images/pix.png" alt="Pix" class="payment-badge" style="padding: 2px; border: none; height: 32px; object-fit: contain; width: auto; background-color: white;">
            <img src="/src/assets/images/boleto.png" alt="Boleto" class="payment-badge" style="padding: 2px; border: none; height: 32px; object-fit: contain; width: auto; background-color: white;">
            <img src="/src/assets/images/amex.png" alt="AMEX" class="payment-badge" style="padding: 2px; border: none; height: 32px; object-fit: contain; width: auto; background-color: white;">
            <img src="/src/assets/images/visa.png" alt="VISA" class="payment-badge" style="padding: 2px; border: none; height: 32px; object-fit: contain; width: auto; background-color: white;">
            <img src="/src/assets/images/mc.png" alt="Mastercard" class="payment-badge" style="padding: 2px; border: none; height: 32px; object-fit: contain; width: auto; background-color: white;">
            <img src="/src/assets/images/hiper.png" alt="Hiper" class="payment-badge" style="padding: 2px; border: none; height: 32px; object-fit: contain; width: auto; background-color: white;">
            <img src="/src/assets/images/elo.png" alt="Elo" class="payment-badge" style="padding: 2px; border: none; height: 32px; object-fit: contain; width: auto; background-color: white;">
          </section>`;

  // normalize newlines for regex replacement
  const targetRegex = /<section class=["']payment-icons["']>\s*<span class=["']payment-badge pix["']>pix<\/span>\s*<span class=["']payment-badge boleto["']>Boleto<\/span>\s*<span class=["']payment-badge amex["']>AMEX<\/span>\s*<span class=["']payment-badge visa["']>VISA<\/span>\s*<span class=["']payment-badge mastercard["']>MC<\/span>\s*<span class=["']payment-badge hiper["']>Hiper<\/span>\s*<span class=["']payment-badge elo["']>elo<\/span>\s*<\/section>/g;
  
  const newContent = content.replace(targetRegex, replacement);
  if(newContent !== content) {
    fs.writeFileSync(file, newContent, 'utf8');
    console.log('Updated ' + file);
  }
});
