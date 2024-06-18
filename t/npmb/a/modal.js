// JS for modal
const modalButtons = document.querySelectorAll('[rel="modal:open"]'); 
modalButtons.forEach(button => {
  button.addEventListener('click', function(event) {
    event.preventDefault(); 
    const modalId = this.getAttribute('href').substring(1);
    const modal = document.getElementById(modalId);
    modal.classList.toggle('show');
    modal.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.classList.remove('show');
      }
    });
    const closeButtons = modal.querySelectorAll('[rel="modal:close"]');
    closeButtons.forEach(closeButton => {
      closeButton.addEventListener('click', () => {
        modal.classList.remove('show');
      });
    });
  });
});