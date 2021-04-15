<template>
    <app-layout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight text-center"
            >
                Crud-byRetr0
            </h2>
        </template>

        <button
            @click="
                modificar = false;
                abrirModal();
            "
            type="button"
            class="btn btn-primary my-4 mx-3"
        >
            Nuevo Estudiante
        </button>

        <hr />
        <!-- Button trigger modal -->
        <!-- <button type="button"   @click="modificar = false;abrirModal();" class="btn btn-primary my-4 mx-3">
  Launch demo modal
</button> -->

        <!-- The Modal -->
        <div class="modal" v-bind:class="{ mostrar: modalEstudiante }">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ tituloModal }}</h4>
                        <button
                            @click="cerrarModal()"
                            type="button"
                            class="close"
                            data-dismiss="modal"
                        >
                            &times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>

                            <input
                                v-model="estudiante.nombres"
                                type="text"
                                class="form-control"
                                id="nombres"
                                placeholder="Nomre del Estudiante"
                            />
                            <span class="text-danger" v-if="errores.nombres">{{
                                errores.nombres[0]
                            }}</span>
                        </div>
                        <div class="form-group">
                            <label for="Apellidos">Apellidos</label>

                            <input
                                v-model="estudiante.apellidos"
                                type="text"
                                class="form-control"
                                id="apellidos"
                                placeholder="Apellidos del Estudiante"
                            />
                            <span
                                class="text-danger"
                                v-if="errores.apellidos"
                                >{{ errores.apellidos[0] }}</span
                            >
                        </div>
                        <div class="form-group">
                            <label for="fecha_de_nacimiento"
                                >Fecha de Nacimiento</label
                            >
                            <input
                                v-model="estudiante.fecha_de_nacimiento"
                                type="date"
                                class="form-control"
                                id="fecha_de_nacimiento"
                                placeholder="Fecha de Nacimiento"
                            />
                            <span
                                class="text-danger"
                                v-if="errores.fecha_de_nacimiento"
                                >{{ errores.fecha_de_nacimiento[0] }}</span
                            >
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input
                                v-model="estudiante.correo"
                                type="email"
                                class="form-control"
                                id="fecha_de_nacimiento"
                                placeholder="Correo Electronico"
                            />
                            <span class="text-danger" v-if="errores.correo">{{
                                errores.correo[0]
                            }}</span>
                        </div>
                        <div class="form-group">
                            <label for="Curso">Curso</label>
                            <select
                                v-model="estudiante.curso"
                                class="custom-select"
                                name="curso"
                                id="nombre_curso"
                            >
                                <option selected disabled>
                                    Selecciona tu Curso
                                </option>

                                <option
                                    :value="y.nombre_curso"
                                    v-for="y in cursos"
                                    :key="y.id"
                                >
                                    {{ y.nombre_curso }}
                                </option>
                            </select>
                            <span class="text-danger" v-if="errores.curso">{{
                                errores.curso[0]
                            }}</span>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button
                            @click="cerrarModal()"
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>
                        <button
                            @click="agregarEstudiantes()"
                            type="button"
                            class="btn btn-success"
                            data-dismiss="modal"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Fecha de Nacimiento</th>
                                <th scope="col">Correo electronico</th>
                                <th scope="col">Curso</th>
                                <th scope="col" colspan="2" class="text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(item, index) in estudiantes"
                                :key="index"
                            >
                                <th scope="row">{{ item.id }}</th>
                                <td>{{ item.nombres }}</td>
                                <td>{{ item.apellidos }}</td>
                                <td>{{ item.fecha_de_nacimiento }}</td>
                                <td>{{ item.correo }}</td>
                                <td>{{ item.curso }}</td>
                                <td>
                                    <button
                                        @click="
                                            modificar = true;
                                            abrirModal(item);
                                        "
                                        class="btn btn-warning"
                                    >
                                        Editar
                                    </button>
                                </td>
                                <td>
                                    <button
                                        @click="eliminarEstudiantes(item.id)"
                                        class="btn btn-danger"
                                    >
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";

export default {
    components: {
        AppLayout,
        Welcome,
    },
    data() {
        return {
            tituloModal: "",
            errores: {},

            modificar: true,
            modalEstudiante: 0,
            modalCurso: 0,
            id: 0,
            erroresCurso: {},
            cursos: [],
            curso: {
                nombre_curso: "",
            },
            estudiantes: [],
            estudiante: {
                nombres: "",
                apellidos: "",
                fecha_de_nacimiento: "",
                correo: "",
                curso: "",
            },
        };
    },
    methods: {
        async listarEstudiantes() {
            const res = await axios.get("api/estudiantes");
            this.estudiantes = res.data;
            console.log(this.estudiantes);
        },
        async listarCurso() {
            try {
                const res = await axios.get("api/cursos");
                this.cursos = res.data;
            } catch (error) {
                console.log(error);
                if (error.response.data) {
                    this.erroresCurso = error.response.data.errors;
                }
            }
        },
        async eliminarEstudiantes(id) {
            const res = await axios.delete("api/estudiantes/" + id);
            if (res.status == 200) {
                Toast.fire({
                    icon: "success",
                    title: res.data,
                });
                this.listarEstudiantes();
            }
        },
        async agregarEstudiantes() {
            try {
                if (this.modificar) {
                    const res = await axios.put(
                        "/api/estudiantes/" + this.id,
                        this.estudiante
                    );
                    let status = res.status;
                    if (status == 201) {
                        Toast.fire({
                            icon: "success",
                            title: res.data,
                        });
                    }
                } else {
                    const res = await axios.post(
                        "/api/estudiantes/",
                        this.estudiante
                    );
                    let status = res.status;
                    if (status == 201) {
                        Toast.fire({
                            icon: "success",
                            title: res.data,
                        });
                    }
                }
                this.cerrarModal();
                this.listarEstudiantes();
            } catch (error) {
                if (error.response) {
                    this.errores = error.response.data.errors;
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log("Error", error.message);
                }
                console.log(error.config);
            }
        },

        abrirModal(data = {}) {
            this.modalEstudiante = 1;
            if (this.modificar) {
                this.tituloModal = "Modificar Datos del Estudiante";
                this.id = data.id;
                this.estudiante.nombres = data.nombres;
                this.estudiante.apellidos = data.apellidos;
                this.estudiante.fecha_de_nacimiento = data.fecha_de_nacimiento;
                this.estudiante.correo = data.correo;
                this.estudiante.curso = data.curso;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Nuevo Estudiante";
                this.estudiante.nombres = "";
                this.estudiante.apellidos = "";
                this.estudiante.fecha_de_nacimiento = "";
                this.estudiante.correo = "";
                this.estudiante.curso = "";
            }
        },
        cerrarModal() {
            this.modalEstudiante = 0;
            this.errores = {};
        },
    },
    mounted() {
        this.listarEstudiantes();
        this.listarCurso();
    },
};
</script>
<style>
.mostrar {
    display: list-item;

    opacity: 1;
    background: rgba(24, 26, 109, 0.5);
}
</style>
