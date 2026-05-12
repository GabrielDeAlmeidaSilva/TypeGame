let keyboard = document.querySelector("#teclado");
const keybLetters = ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'ç', 'z', 'x', 'c', 'v', 'b', 'n', 'm'];

for(let i = 0; i <= 26; i++){
  const key = document.createElement('div');
  key.className = "key";
  key.id = `key${i}`;

  let letter = document.createElement('p');
  letter.textContent = keybLetters[i];
  key.appendChild(letter);
  keyboard.appendChild(key);
}
