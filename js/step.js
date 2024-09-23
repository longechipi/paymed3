var currentTab = 0
showTab(currentTab)

function showTab(n) {
  var x = document.getElementsByClassName('step')
  x[n].style.display = 'block'
  if (n == 0) {
    document.getElementById('prevBtn').style.display = 'none'
  } else {
    document.getElementById('prevBtn').style.display = 'inline'
  }
  if (n == x.length - 1) {
    document.getElementById('nextBtn').innerHTML = 'Guardar'
  } else {
    document.getElementById('nextBtn').innerHTML = 'Siguiente'
  }
  fixStepIndicator(n)
}

function nextPrev(n) {
  var x = document.getElementsByClassName('step')
  if (n == 1 && !validateForm()) return false
  x[currentTab].style.display = 'none'
  currentTab = currentTab + n
  if (currentTab >= x.length) {
    document.getElementById('signUpForm').submit()
    return false
  }
  showTab(currentTab)
}

function validateForm() {
  var x,
    y,
    i,
    valid = true
  x = document.getElementsByClassName('step')
  y = x[currentTab].querySelectorAll('input:not([type="file"]),select')

  const camposAExcluir = [
    'idpaisint',
    'idbcoint',
    'nrocuentaint',
    'ach',
    'swit',
    'aba',
    'dircta',
    'telefono',
    'codpostalint'
  ]

  for (i = 0; i < y.length; i++) {
    if (!camposAExcluir.includes(y[i].id) && !y[i].value) {
      y[i].classList.add('invalid')
      valid = false
    }
  }

  if (valid) {
    document.getElementsByClassName('stepIndicator')[currentTab].className += ' finish'
  }
  return valid
}

function fixStepIndicator(n) {
  var i,
    x = document.getElementsByClassName('stepIndicator')
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(' active', '')
  }
  x[n].className += ' active'
}
