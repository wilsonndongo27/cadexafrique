@extends('analytics/template')
@section('contenu')
<div class="container-fluid">
    <h1 class="mt-4">Analytics</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Gestion du support clients/visiteurs</li>
    </ol>
    <table id="articles-table" class="table shadow-card">
        <thead style="margin-left:5px">
            <tr style="font-size: 14px;">
                <th title="">{{ __('Noms complets') }}</th>
                <th title="">{{ __('Emails') }}</th>
                <th title="">{{ __('Numéro de téléphone') }}</th>
                <th title="">{{ __('Intérêts') }}</th>
                <th title="">{{ __('Status') }}</th>
                <th title="" style="width:3px;"> > </th>
                <span class="counter"> Total des tickets <span class="badgecount">{{ count($allsupport)}}</span></span>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">
        @if ($allsupport ?? '')
            @foreach ($allsupport as $item)
                <tr>
                    <td style="color: #888;">{{ $item->name }}</td>
                    <td style="color: #888;">{{ $item->email }}</td>
                    <td style="color: #888;">{{ $item->telephone }}</td>
                    <td style="color: #888;">{{ $item->interest }}</td>
                    @if($item->status == 0)
                    <td style="color: #F07000;">En attente de traitement</td>
                    @else
                    <td style="color: #F07000;">Déjà traité</td>
                    @endif
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn"><p style="font-size: 13px; margin-top:-10px;">Options</p></button>
                            <div class="dropdown-content">
                              <a href="Javascript:void()" id="sendmail"
                                data-ticketid="{{ $item->id }}"
                                data-name="{{ $item->name }}"
                                data-emaildest="{{ $item->email }}"
                              ><i class="fa fa-envelope" style="margin-right: 3px;"></i>Envoie mail</a>
                              <a href="JavaScript:void()" id="deleteticketmodal"
                                data-idticket="{{ $item->id }}"
                              ><i class="fa fa-trash" style="margin-right: 3px;"></i>Supprimer</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <p style="font-size: 14px; margin-top:50px; color:#888">Liste de ticket vide!</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- modale pour lenvoie des mails  -->
    <div id="SendMailModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="width: 50px; height:50px; border-radius:5px" src="{{ asset ('images/logoglobalfinance.png')}}"/>
                        <h4 class="modal-title" style="margin-left: 11px;font-size:18px; font-weight:bold">{{ __('Envoie du mail Support') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createform" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('send-mail')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="ticket" id="idticket"/>
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">{{  __('Destinataire') }}</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input readonly class="form-control" id="emaildest" name="email" style="border-radius:5px" required placeholder="Email du destinataire" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="color: #888" for="exampleFormControlTextarea1">{{ __('Message')}}</label>
                            <textarea class="form-control" id="textarea" name="message"  required rows="3" placeholder="Corp du message"></textarea>
                        </div>

                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p style="color: #888">{{ __('Pièce jointe') }}</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" name="file" style="border-radius:5px" required  />
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttomcreate" class="btn btn-primary newBtn">{{ __('Envoyez') }}</button>
                        <div class="textalert"  id="errorformcreate"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modale pour supprimer les tickets -->
    <div id="DeleteTicket" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img style="width: 50px; height:50px; border-radius:5px" src="{{ asset ('images/logoglobalfinance.png')}}"/>
                    <h4 class="modal-title" style="margin-left: 11px; font-size:18px; font-weight:bold">{{ __('Supprimer le ticket') }}</h4>
                    <button style="margin-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="delete_form" lpformnum="1"  method="post" enctype="multipart/form-data" action="{{ route ('delete-ticket')}}">
                    <div class="modal-body" style="font-size:14px">
                        @csrf
                        <input type="hidden" name="currentticket" id="idticketform" />
                        <div class="row" style="margin-top: -10px;">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>{{  __('Voulez vous vraiment suprimer ce ticket ?') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">{{ __('Annuler') }}</button>
                        <button type="submit" id="buttondelete" class="btn btn-primary newBtn">{{ __('Supprimer') }}</button>
                        <div class="textalert"  id="errorformdelete"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end popup -->

</div>
@endsection

