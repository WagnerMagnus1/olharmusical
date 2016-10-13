<div class="col-md-12">
            <div class="section">
              <div class="container">
                <div class="row">
                    <div class="row">
                      <div class="col-md-12">
                          <center>
                          <div id="imgperfil" data-toggle="context" data-target="#context-menu" class="col-md-12 espaco_cima">
                                <img id="uploadPreview" src="<?php echo $dados['pessoa_foto']?>" class="img-responsive img-thumbnail"><br>
                          </div>
                          </center>
                      </div>
                    </div>
                    <div class="col-md-12 text-center" id="dashboard-col">
                      <h4 class="text-center"><?php echo $dados['pessoa_nome']?> <?php echo @$dados['pessoa_sobrenome']?></h4>      
                    </div>
                    <br>
                  <br>
                </div>
              </div>
              <input id="id_pessoa" type="hidden" name="id_pessoa" value="<?php echo $dados['pessoa_id']?>"><br><br>
              <div class="row">
                  <div class="col-md-2"></div>
                 <div class="col-md-8">
                  <table class="table table-striped">
                          <tbody>
                            <tr>
                              <th scope="row">Telefone:</th>
                              <td><label id="semquebralinha"><?php echo @$dados['pessoa_telefone'] ?></label></td>
                            </tr>
                             <tr>
                              <th scope="row">Contato:</th>
                              <td><label id="semquebralinha"><?php echo @$dados['pessoa_contato'] ?></label></td>
                            </tr>
                             <tr>
                              <th scope="row">Observação:</th>
                              <td><label id="semquebralinha"><?php echo @$dados['pessoa_obs'] ?></label></td>
                            </tr>
                            <tr>
                              <th scope="row">Sexo:</th>
                              <td><label id="semquebralinha"><?php echo @$dados['pessoa_sexo'] ?></label></td>
                            </tr>
                          </tbody>
                        </table><hr>
                 </div>
                 <div class="col-md-2"></div>
              </div>
              <?php if($funcao){?>
                <div class="row">
                  <div class="col-md-12">
                    <center><p>Da cidade de <?php echo $dados['pessoa_cidade'].'/ '.$dados['pessoa_estado']?>, com <?php echo $pessoa_idade?> anos de idade.</p></center>          
                    <center><p>Atualmente, <?php if($dados['pessoa_sexo']=='Masculino'){echo 'o ';}else{echo 'a ';}echo $dados['pessoa_nome']?> exerce as seguintes funções:</center>
                    <?php foreach($funcao as $f){?><center><h3 id="semquebralinha" class="glyphicon glyphicon-hand-right"> <?php echo $f['funcao_nome'];}?></h3></center></p>
                  </div>
                </div>
                <?php }else{?>
                  <div class="row">
                    <div class="col-md-12">
                      <center><p>Da cidade de <?php echo $dados['pessoa_cidade'].'/ '.$dados['pessoa_estado']?>, com <?php echo $pessoa_idade?> anos de idade.</p></center>
                      <center><p>Atualmente, não atua em nenhuma função.</p></center>
                    </div>
                  </div>
                <?php }?>

                    <br><br><br><div class="row espaco_baixo">
                          <?php if($atividade) {?>
                            <div class="col-md-6">
                              <button data-toggle="modal" data-target="#modalconviteatividade" type="button" class="btn btn-block btn-info btn-lg"><span class="glyphicon glyphicon-send"></span> Convidar para atividade</button>
                              <button data-toggle="modal" data-target="#cancelarnotificacao" type="button" class="btn btn-block btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar Convite</button>    
                            </div>
                          <?php }else{?>
                            <div class="col-md-6">
                              <center><h4><a id="mao" href="<?php echo base_url('pagina/index')?>">Crie uma atividade para poder convida-lo</a></h4><center>
                            </div>
                          <?php }?>
                          <div class="col-md-6">
                            <button value="cadastrar" class="btn btn-block btn-info btn-lg"><span class="glyphicon glyphicon-send"></span> Convidar para minha banda</button>
                            <button data-toggle="modal" data-target="#" type="button" class="btn btn-block btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar Convite</button>  
                          </div>                         
                      <br>    
                    </div> 
              </div>
            </div>


            <!--  MODAL PARA NOTIFICAR ATIVIDADE-->
                          <div class="modal fade" id="modalconviteatividade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel">Escolha a atividade para convidar <?php echo $dados['pessoa_nome']?></h4>
                                </div>
                                  <div class="modal-body">
                                      <form id="notificaratividade" role="form" method="POST" name="notificaratividade" action="<?php echo base_url('atividade/notificar'); ?>">
                                       <input id="id_pessoa" type="hidden" name="id_pessoa" value="<?php echo $dados['pessoa_id']?>">
                                        <fieldset><br>
                                            <p class="control-label">Selecione a atividade:</p>
                                            <label class="control-label"> Obs.: As atividades em AZUL ja possuem a participação de <?php echo $dados['pessoa_nome']?></label><br>
                                            <label class="control-label"> Obs.: As atividades em CINZA foram notificadas e aguardam aprovação de <?php echo $dados['pessoa_nome']?></label>
                                             <label class="control-label"> Obs.: As atividades em VERMELHO foram recusadas por <?php echo $dados['pessoa_nome']?></label>
                                          <select id="all" class="form-control selectpicker" data-size="7" name="atividade" required> 
                                          <option value="" disabled selected>Selecione uma atividade</option>     
                                                <?php foreach($atividade as $a) { ?>
                                                    <option value="<?php echo $a['atividade_id']?>"><?php echo $a['atividade_titulo']?> - <?php echo $a['atividade_tipo']?> (<?php echo date('d/m/Y H:i:s', strtotime($a['atividade_data']));?>)</option>
                                                <?php } ?>
                                          </select>
                                        </fieldset>
                                        
                                         <script>                
                                          var valueparticipa = '<?php echo $participa; ?>';

                                          $.each(valueparticipa.split(","), function(i,e){
                                              $("#all option[value='" + e + "']").css('color','blue');
                                              $("#all option[value='" + e + "']").prop('disabled',true);
                                              $("#all option[value='']").css('color','silver');
                                          });

                                          var valuependente = '<?php echo $pendente; ?>';

                                          $.each(valuependente.split(","), function(i,e){
                                              $("#all option[value='" + e + "']").css('color','#A9A9A9');
                                              $("#all option[value='" + e + "']").prop('disabled',true);
                                              $("#all option[value='']").css('color','silver');
                                          });

                                           var valuerecusado = '<?php echo $recusado; ?>';

                                          $.each(valuerecusado.split(","), function(i,e){
                                              $("#all option[value='" + e + "']").css('color','red');
                                              $("#all option[value='" + e + "']").prop('disabled',true);
                                              $("#all option[value='']").css('color','silver');
                                          });
                                        </script>

                                         <fieldset><br>
                                            <p class="control-label">Selecione a função onde deseja que <?php echo $dados['pessoa_nome']?> atue:</p>
                                          <select id="all" class="form-control selectpicker" data-size="7" name="funcao" required>  
                                          <option value="" disabled selected>Selecione uma função</option>  
                                                <?php foreach($funcao as $a) { ?>
                                                    <option value="<?php echo $a['funcao_id']?>"><?php echo $a['funcao_nome']?></option>
                                                <?php } ?>
                                          </select>
                                        </fieldset>
                                        
                                        <div class="modal-footer"><hr>
                                            <button type="button" id="cancelar" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                              <script>
                                                $('#cancelar').click(function() {
                                                    $('#convidaratividade')[0].reset();
                                                    $('option:selected').removeAttr('selected');
                                                }); 
                                              </script> 
                                            <button name="notificaratividade" type="submit" class="btn btn-primary" value="Notificar">Notificar</button>
                                        </div>
                                      </form>
                                  </div>
                              </div>
                            </div>
                          </div>



<!-- MODAL PARA CANCELAR NOTIFICAÇÃO-->
 <div class="modal fade" id="cancelarnotificacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <center><h3 class="modal-title" id="myModalLabel">Notificações Enviadas:</h3></center>
                                </div>
                                  <div class="modal-body">
                                      <table class="table table-striped">
                                      <tbody>

                                        <?php foreach($atividade as $a) { ?>
                                           <?php for($i=0;$i<count($pendente_completo);$i++){?>
                                             <?php if($a['atividade_id'] == $pendente_completo[$i]['atividade_id']){ ?>
                                                <tr>
                                                  <td>
                                                    <label id="semquebralinha" value="<?php echo $a['atividade_id']?>">Atividade "<?php echo $a['atividade_titulo']?> - <?php echo $a['atividade_tipo']?> (<?php echo date('d/m/Y H:i:s', strtotime($a['atividade_data']));?>)"</label>
                                                    <button id="cancelaratividade<?php echo $a['atividade_id']?>" type="button" class="btn pull-right btn-danger"><span class="glyphicon glyphicon-remove"></span> excluir solicitação</button>
                                                  </td>
                                                </tr>

                                                <script>
                                                $('#cancelaratividade<?php echo $a['atividade_id']?>').click(function() {
                                                    var dados = {
                                                      pessoa : "<?php echo $pendente_completo[$i]['pessoa_id'] ?>",
                                                      atividade : "<?php echo $pendente_completo[$i]['atividade_id'] ?>",
                                                      funcao : "<?php echo $pendente_completo[$i]['Funcoes_funcao_id'] ?>"
                                                    };

                                                    $.ajax({            
                                                        type: "POST",
                                                        data: { dados: JSON.stringify(dados)},
                                                        datatype: 'json',
                                                        url: "<?php echo site_url('atividade/cancelarconviteatividade'); ?>",      
                                                        success: function(data){     
                                                          window.location.href = "<?php echo base_url('pessoa/dados')?>";
                                                        },
                                                        error: function(e){
                                                          alert('Erro! Por favor tente novamente.');
                                                            console.log(e.message);
                                                        }
                                                    }); 
                                                });
                                              </script> 
                                              
                                            <?php } ?>
                                          <?php } ?>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                              </div>
                            </div>
                          </div>
                                              