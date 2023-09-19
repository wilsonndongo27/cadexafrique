<!-- Modal sign up global -->

<!-- Modal -->
<div class="modal fade signupModal" id="myModalNorm" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content contentmodal">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    Rejoignez-nous
                </h4>
                <button type="button" class="close modalclose"
                    onclick="CloseModalSignUP()"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only"></span>
                </button>
            </div>

            <!-- Modal Body -->

            <form id="signupform" method="POST" action="{{ route ("signup-user")}}" role="form">
                @csrf
                <div class="modal-body">
                    <div class="blockinput">
                        <div class="form-group form-group-review">
                            <input type="hidden" value="particulier" required name="compte_type">
                            <input type="hidden" name="username" id="username" required>
                            <label for="InputNom">Nom et Prénom</label>
                            <input type="text" name="name" required class="form-control"
                            id="InputNom" placeholder="Enter votre nom suivie de votre prénom"/>
                        </div>
                    </div>

                    <div class="blockinput">
                        <div class="form-group form-group-review">
                            <label for="InputPhone">Téléphone</label>
                            <input type="text" class="form-control" required name="telephone"
                            id="InputPhone" placeholder="Enter Numero de téléphone"/>
                        </div>
                    </div>

                    <div class="blockinput">
                        <div class="form-group form-group-review">
                            <label for="InputEmail1">adresse email</label>
                            <input type="email" class="form-control" required name="email"
                            id="InputEmail1" placeholder="Enter email" onchange="ChangeUsername(this)"/>
                            <span id="error_email" style="color: #a94442 !important" class="help-block"></span>
                        </div>
                    </div>

                    <div class="blockinput">
                        <div class="form-group form-group-review">
                            <label for="InputPassword1">Password</label>
                            <input type="password" class="form-control" required name="password"
                                id="InputPassword1" placeholder="Password"/>
                            <span id="error_password1" style="color: #a94442 !important" class="help-block"></span>
                        </div>
                    </div>


                    <div class="blockinput">
                        <div class="form-group form-group-review">
                            <label for="InputPassword2">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" required
                                id="InputPassword2" placeholder="Password"/>
                            <span id="error_password2" style="color: #a94442 !important" class="help-block"></span>
                        </div>
                    </div>

                    <div class="checkbox checkbookblock">
                        <label>
                            <input type="checkbox" required/>
                            En soumettant ce formulaire, J'accepte que les informations saisies soient exploitées  pour améloirer mon experience sur les <a href="#">produits CADEX et dérivés.
                        </label>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <div id="statusmessage"></div>
                    <button type="button"   class="btn btn-default closemodal"
                            data-dismiss="modal" onclick="CloseModalSignUP()">
                                Annuler
                    </button>
                    <button type="submit" id="signupbtn" class="btn btn-primary sendrequestsignup btncontact">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Activate Account -->
<div class="modal fade signupModalActivateAccount" id="myModalNorm" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content contentmodal">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close modalclose"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only"></span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Nous vous avons envoyez un code de confirmation dans votre boite email.
                </h4>
            </div>

            <!-- Modal Body -->
            <form id="signupactivateform" method="POST" action="" role="form">
                @csrf
                <div class="modal-body">
                    <div class="blockinput">
                        <div class="form-group">
                            <label for="InputNom">Entrer le code ici pour activer votre compte.</label>
                            <input type="text" name="code" required class="form-control"
                            id="InputCode" placeholder="Enter votre code"/>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <div id="statusmessageactivate"></div>
                    <button type="button" class="btn btn-default closemodal"
                            data-dismiss="modal">
                                Annuler
                    </button>
                    <button type="submit" id="signupbtnactivate" class="btn btn-primary sendrequestsignup btncontact">
                        Envoyez
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
