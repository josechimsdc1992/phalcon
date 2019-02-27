{% extends "layouts/base.volt" %}

{% block content %}

 <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Register</h2>
          <h3 class="section-subheading text-muted"></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form id="contactForm" method="post" action="{{ url('signin/doregister') }}">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" name="password" id="password" type="password" placeholder="Your Password*" required="required" data-validation-required-message="Please enter your password.">
                  <p class="help-block text-danger"></p>
                </div>
                 <div class="form-group">
                  <input class="form-control" name="confirm_password" id="password" type="password" placeholder="Your Password*" required="required" data-validation-required-message="Please confirm your password.">
                  <p class="help-block text-danger"></p>
                </div>
               
              </div>
              
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Registrar</button>
                <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}">
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </section>

{% endblock %}