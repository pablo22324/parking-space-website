// kolorwanie miejsc w wolnych miesjcach
function kolorowanie() {
  for (i = 0; i < zajete.length; i++) {
    document.getElementById(zajete[i]).style.backgroundColor = "red";
  }
  for (i = 0; i < wolne.length; i++) {
    document.getElementById(wolne[i]).style.backgroundColor = "green";
  }
}
document.addEventListener("DOMContentLoaded", opcje);
// automatyczna lista miejsc bo oczy krwiawią
function opcje() {
  const select = document.getElementById("miejsce");
  select.value = null;
  const miejsca = [
    ...Array.from({ length: 16 }, (_, i) => i + 1), // 1-16
    ...Array.from({ length: 16 }, (_, i) => 101 + i), // 101-116
    ...Array.from({ length: 16 }, (_, i) => 201 + i), // 201-216
  ];

  miejsca.forEach((num) => {
    const option = document.createElement("option");
    option.value = num;
    option.textContent = num;
    select.appendChild(option);
  });
}
