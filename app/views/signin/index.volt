{% extends "layouts/base.volt" %}

{% block content %}

 <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Login</h2>
          <h3 class="section-subheading text-muted"></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form id="contactForm" method="post" action="{{ url('signin/logear') }}">

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" name="password" id="password" type="password" placeholder="Your Password*" required="required" data-validation-required-message="Please enter your password.">
                  <p class="help-block text-danger"></p>
                </div>
                
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Acceder</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

{% endblock %}