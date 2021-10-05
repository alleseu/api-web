<main>
    <!-- SECCIÓN: MENSAJE DE ERRORES -->
    <section class="container">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">¡Error!</h4>
            <p class="text-center"> <?=$this->data['mensaje'];?> </p>
        </div>
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary" href="/api-web">Volver</a>
        </div>
    </section>
</main>

<!-- JS PARA LA LÓGICA DE LA VISTA: -->
<script type="text/javascript" src="src/Views/js/error.js"></script>