const name = document.getElementById('username')
const password = document.getElementById('password')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')

form.addEventListener('submit', (e) => {
  let messages = []
  if (name.value === '' || name.value == null) {
    messages.push('Name is required')
  }

  if(username.value.length <= 4){

	messages.push("Username must be longer than or equal to 4 characters")
  }

  if (password.value.length <= 8) {
    messages.push('Password must be longer than or equal to 8 characters')
  }

  if (password.value.length >= 20) {
    messages.push('Password must be less than or equal to 20 characters')
  }

  if (messages.length > 0) {
    e.preventDefault()
    errorElement.innerText = messages.join(', ')
  }
})