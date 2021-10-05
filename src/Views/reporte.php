<main>
    <!-- SECCIÓN: GRÁFICOS -->
    <section class="container">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <button class="nav-link active" data-name="grafico1"> Gráfico 1</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-name="grafico2"> Gráfico 2</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-name="grafico3"> Gráfico 3</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-name="grafico4"> Gráfico 4</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <canvas class="graphy" width="200" height="200" id="grafico1"></canvas>
                <canvas class="graphy d-none" width="200" height="200" id="grafico2"></canvas>
                <canvas class="graphy d-none" width="200" height="200" id="grafico3"></canvas>
                <canvas class="graphy d-none" width="200" height="200" id="grafico4"></canvas>
            </div>
        </div>
    </section>

    <!-- SECCIÓN: TABLA RESUMEN -->
    <section class="container">
        <div class="card text-center">
            <div class="card-header">
                <h6 class="card-title">Tabla Resumen</h6>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered w-100" id="tabla_resumen">
                    <thead>
                        <tr>
                            <th class="text-center">Nº</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Género</th>
                            <th class="text-center">Hobby</th>
                            <th class="text-center">Tiempo (Horas)</th>
                            <th class="text-center">Fecha</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary" href="/api-web">Volver</a>
        </div>
    </section>
</main>

<!-- JS PARA LA LÓGICA DE LA VISTA: -->
<script type="text/javascript" src="src/Views/js/reporte.js"></script>