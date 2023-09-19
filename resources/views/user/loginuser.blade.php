<!-- Modal -->
<div class="modal fade LoginModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog logindialog">
        <div class="modal-content loginmodal contentmodal">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    Connexion
                </h4>
                <button type="button" class="close modalclose" onclick="CloseModalLogin()"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only"></span>
                </button>
            </div>

            <!-- Modal Body -->

            <form id="loginform" method="POST" action="{{ route ("login_post_user")}}" role="form">
                @csrf
                <input type="hidden" id="is_from_direct_pay">
                <div class="modal-body loginbodymodal">
                    <div class="blockinput">
                        <div class="form-group">
                            <label for="InputNomLogin">Adresse email</label>
                            <input type="email" name="email" required class="form-control"
                            id="InputNomLogin" placeholder="Veiller saisir votre adresse email"/>
                        </div>
                    </div>

                    <div class="blockinput">
                        <div class="form-group" >
                            <label for="InputPassword">Mot de passe</label>
                            <input type='password' id="InputPassword" class="form-control"
                            placeholder="Veiller saisir votre mot de passe"  required name="password" />
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <div id="statusmessagelogin"></div>
                    <button onclick="CloseModalLogin()" type="button"   class="btn btn-default closemodal"
                            data-dismiss="modal">
                                Annuler
                    </button>
                    <button type="submit" id="loginbtn" class="btn btn-primary sendrequestsignup btncontact">
                        Connexion
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
