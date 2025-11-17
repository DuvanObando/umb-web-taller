function describirPrioridad(nivel) {
  let mensaje = ''Prioridad no definida'';
  switch (nivel) {
    case ''alta'':
      mensaje = ''Prioridad alta: atender de inmediato'';
      break;
    case ''media'':
      mensaje = ''Prioridad media: agendar pronto'';
      break;
    case ''baja'':
      mensaje = ''Prioridad baja: se puede esperar'';
      break;
    default:
      mensaje = ''Sin prioridad registrada'';
  }
  return mensaje;
}

function sumarSinSeis() {
  let suma = 0;
  for (let i = 1; i <= 10; i++) {
    if (i === 6) {
      continue;
    }
    suma += i;
  }
  return suma;
}

window.addEventListener(''DOMContentLoaded'', () => {
  const prioridadTexto = document.getElementById(''prioridad-texto'');
  const sumaTexto = document.getElementById(''suma-texto'');

  if (prioridadTexto) {
    prioridadTexto.textContent = describirPrioridad(''media'');
  }

  if (sumaTexto) {
    sumaTexto.textContent = ''Suma 1..10 sin el 6: '' + sumarSinSeis();
  }
});
