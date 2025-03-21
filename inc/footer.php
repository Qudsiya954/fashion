 <!-- Footer -->


 <footer>
   <div class="container">
     <div class="row">
       <div class="col-md-4">
         <h4>FashionGuide</h4>
         <p>Your personal style companion</p>
       </div>
       <div class="col-md-4">
         <h4>Quick Links</h4>
         <ul class="list-unstyled">
           <li><a href="/about.html">About Us</a></li>
           <li><a href="/contact.html">Contact</a></li>
           <li><a href="#privacy">Privacy Policy</a></li>
         </ul>
       </div>
       <div class="col-md-4">
         <h4>Connect With Us</h4>
         <div class="social-icons">
           <a href="#"><i class="fab fa-facebook"></i></a>
           <a href="#"><i class="fab fa-instagram"></i></a>
           <a href="#"><i class="fab fa-pinterest"></i></a>
         </div>
       </div>
     </div>
   </div>
 </footer>


 <script>
   
   function alert(type, msg, position = 'body') {
     let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
     let element = document.createElement('div')
     element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert" >
            <strong class="me-3">${msg}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;

     if (position == 'body') {
       document.body.append(element)
       element.classList.add('custome-alert')

     } else {
       document.getElementById(position).appendChild(element)
     }
     setTimeout(remAlert, 3000)
   }

   function remAlert() {
     document.getElementById('alert')[0].remove();
   }


  //  register form backend

   let register_form = document.getElementById('register-form')
   register_form.addEventListener('submit', (e) => {
         e.preventDefault()
         let data = new FormData(register_form);

         data.append('name', register_form.elements['name'].value)
         data.append('email', register_form.elements['email'].value)
         data.append('phonenum', register_form.elements['phonenum'].value)
         data.append('gender', register_form.elements['gender'].value)

         data.append('dob', register_form.elements['dob'].value)
         data.append('pass', register_form.elements['pass'].value)
         data.append('cpass', register_form.elements['cpass'].value)
         data.append('profile', register_form.elements['profile'].files[0])

         data.append('register', '')
         var myModal = document.getElementById('registerModal');
         var modal = bootstrap.Modal.getInstance(myModal);
         modal.hide();

         let xhr = new XMLHttpRequest();
         xhr.open('POST', 'ajax/login_register.php', true);

         xhr.onload = function() {
             if (this.responseText === 'pass_mismatched') {
                 alert('error', "Password mismatch")
             } else if (this.responseText === 'email_already') {
                 alert('error', "Email already exists")
             } else if (this.responseText === 'phone_already') {
                 alert('error', "Phone number already exists")
             } else if (this.responseText === 'inv_image') {
                 alert('error', "Only jpeg, jpg, webp images allowed")
             } else if (this.responseText === 'upd_failed') {
                 alert('error', "Failed to upload image")
             } else if (this.responseText === 'mail_failed') {
                 alert('error', "Failed to send mail")
             } else if (this.responseText === 'ins_failed') {
                 alert('error', "Failed to insert data")
             } else {
                 alert('success', "Registration successful!!")
                 register_form.reset();
             }
         }
         xhr.send(data);

     })

  
 </script>