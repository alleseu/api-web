<main>
    <!-- SECCIÓN: FORMULARIO ENCUESTA -->
    <section class="container">
        <form class="card" method="post" action="/api-web/encuesta" id="formulario">
            <div class="card-body">
                <div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="nombre" name="nombre" minlength="2" maxlength="100">
                        <label class="error text-danger" for="nombre" style="display:none;"></label>
                    </div>
                </div>
                <fieldset class="form-group row">
                    <legend class="col-form-label col-sm-2 float-sm-left pt-0">Género</legend>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="radio1" name="genero" value="1">
                            <label class="custom-control-label" for="radio1">Mujer</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="radio2" name="genero" value="2">
                            <label class="custom-control-label" for="radio2">Hombre</label>
                        </div>
                        <label class="error text-danger" for="genero" style="display:none;"></label>
                    </div>
                </fieldset>
                <fieldset class="form-group row">
                    <legend class="col-form-label col-sm-2 float-sm-left pt-0">¿Tienes algún hobby?</legend>
                    <div class="col-sm-10">
                        <?php foreach ($this->data['hobbys'] as $key => $value): ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="<?=$key;?>" name="hobby" value="<?=$value['id'];?>">
                                <label class="custom-control-label" for="<?=$key;?>"> <?=$value['descripcion'];?> </label>
                            </div>
                        <?php endforeach; ?>
                        <label class="error text-danger" for="hobby" style="display:none;"></label>
                    </div>
                </fieldset>
                <div class="form-group row" id="seccion_tiempo">
                    <label for="tiempo" class="col-sm-2 col-form-label">¿Cuánto tiempo le dedicas al mes?</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="tiempo" name="tiempo" min="1" max="720">
                        <label class="error text-danger" for="tiempo" style="display:none;"></label>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary" type="button" id="boton_registrar">Siguiente</button>
            </div>
        </form>	
    </section>
</main>

<!-- JS PARA LA LÓGICA DE LA VISTA: -->
<script type="text/javascript" src="src/Views/js/encuesta.js"></script>