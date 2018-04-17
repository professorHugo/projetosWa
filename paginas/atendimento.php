            </div>
        </div>
        <style media="screen">
          div.alert {
            display: none;
          }
        </style>
        <div class="breadcrumb">
            <div class="container">
                <h1>Atendimentos</h1>
                <hr>
            </div>
        </div>

        <div class='alert alert-success container' role='alert'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          Mensagem enviada com sucesso!
        </div>

        <div class='alert alert-danger container' role='alert'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          Não foi possível enviar a mensagem.
        </div>

        <div class="container">
            <form name="contactForm" id="contact_form" action="ajax/send_mail.php" class="form-clean" method="post">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input name="nome" type="text" class="form-control" placeholder="*Nome:" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <input name="telefone" type="tel" class="form-control" placeholder="Telefone:">
                                </div>
                                <div class="col-xs-6">
                                    <input name="celular" type="tel" class="form-control" placeholder="Celular:">
                                </div>
                            </div>
                        </div>
                        <textarea name="mensagem" class="form-control" rows="5" placeholder="Mensagem:" required></textarea>
                    </div>
                    <div class="col-md-5">
                        <div class="form-horizontal m_md_t_30">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input name="email" type="email" class="form-control" placeholder="*Email:" required>
                                </div>
                            </div>
                            <select name="duvida" class="form-control">
                                <option value="" selected disabled>Duvidas:</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <ul class="list_contact" style="margin-top:1em;">
                            <li><a href="tel:+551532026062" target="_blank" class="trans3"><i class="trans5 fa fa-phone"></i><b>(15) 3202-6062</b></a></li>
                            <li><a class="trans3"><i class="trans5 fa fa-envelope"></i>contato@campovel.com.br</a></li>
                            <li><a href="https://goo.gl/maps/Z3LPnhy6a4A2" target="_blank" class="trans3"><i class="trans5 fa fa-map-marker"></i>Avenida Dr Afonso Vergueiro 2635  -  Sorocaba</a></li>
                            <!-- <li><a class="trans3"><i class="trans5 fa fa-twitter"></i>@campovel</a></li> -->
                        </ul>
                    </div>
                </div>

                <label for="newsletter-checkbox" style="color:#3e4095;cursor:pointer;display:block;text-transform:uppercase;">
                  <input id="newsletter-checkbox" type="checkbox" name="newsletter-checkbox" checked> Receber informativos da Campovel
                </label>

                <button name="submitContato" type="submit" class="send_form trans3" style="border-top:0;border-right:0;border-left:0;">Enviar</button>
            </form>
        </div>
