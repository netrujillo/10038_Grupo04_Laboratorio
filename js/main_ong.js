window.addEventListener('load', function () {
    const columns = document.querySelectorAll('.col-md-4');
    
    columns.forEach(function (column, index) {
      const delay = 400; 
      
      setTimeout(function () {
        column.classList.add('visible');
      }, index * delay);
    });
  });