<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crud Cursos
            </h2>
        </template>
        <button
            type="button"
            class="btn btn-primary my-4 mx-3"
            @click="
                modificar = false;
                abrirModal();
            "
        >
            Nuevo Curso
        </button>
        <hr />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">
                                    Nombre de los Cursos
                                </th>
                                <th scope="col" class="text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in cursos" :key="index">
                                <th scope="row">{{ item.id }}</th>
                                <td class="text-center">
                                    {{ item.nombre_curso }}
                                </td>

                                <td class="text-center">
                                    <button
                                        @click="
                                            modificar = true;
                                            abrirModal(item);
                                        "
                                        class="btn btn-warning mb-1 ml-1"
                                    >
                                        Editar
                                    </button>
                                    <button
                                        @click="EliminarCurso(item.id)"
                                        class="btn btn-danger mb-1 ml-1"
                                    >
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal" v-bind:class="{ mostrar: modalCurso }">
                        <div
                            class="modal-dialog modal-dialog-scrollable"
                            role="document"
                        >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        {{ tituloModal }}
                                    </h5>
                                    <button
                                        type="button"
                                        class="close"
                                        @click="cerrarModal()"
                                        aria-label="Close"
                                    >
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="curso">Curso</label>

                                        <input
                                            v-model="curso.nombre_curso"
                                            type="text"
                                            class="form-control"
                                            id="nombre_curso"
                                            placeholder="Nombre del Curso"
                                        />
                                        <span
                                            class="text-danger"
                                            v-if="errores.nombre_curso"
                                            >{{ errores.nombre_curso[0] }}</span
                                        >
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal"
                                        @click="cerrarModal()"
                                    >
                                        Cerrar
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        @click="CrearCurso()"
                                    >
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
            id: 0,
            status: [],
            modificar: true,
            tituloModal: "",
            modalCurso: 0,
            errores: {},
            cursos: [],
            curso: {
                nombre_curso: "",
            },
        };
    },
    methods: {
        async listarCurso() {
            try {
                const res = await axios.get("api/cursos");
                this.cursos = res.data;
            } catch (error) {
                console.log(error);
                if (error.response.data) {
                    this.errores = error.response.data.errors;
                }
            }
        },

        async EliminarCurso(id) {
            try {
                const res = await axios.delete("api/cursos/" + id);
                if (res.status == 200) {
                    Toast.fire({
                        icon: "success",
                        title: res.data,
                    });
                }
                this.listarCurso();
            } catch (error) {
                console.log(error);
                if (error.response.data) {
                    this.errores = error.response.data.errors;
                }
            }
        },
        async CrearCurso() {
            try {
                if (this.modificar) {
                    const res = await axios.put(
                        "api/cursos/" + this.id,
                        this.curso
                    );
                    let status = res.status;
                    if (status == 201) {
                        Toast.fire({
                            icon: "success",
                            title: res.data,
                        });
                    }
                } else {
                    const res = await axios.post("api/cursos/", this.curso);
                    let status = res.status;
                    if (status == 201) {
                        Toast.fire({
                            icon: "success",
                            title: res.data,
                        });
                    }
                }
                this.cerrarModal();
                this.listarCurso();
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
            this.modalCurso = 1;
            if (this.modificar) {
                this.tituloModal = "Modificar Datos del Estudiante";
                this.id = data.id;
                this.curso.nombre_curso = data.nombre_curso;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Nuevo Estudiante";
                this.curso.nombre_curso = "";
            }
        },
        cerrarModal() {
            this.modalCurso = 0;
            this.errores = {};
        },
    },
    mounted() {
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
