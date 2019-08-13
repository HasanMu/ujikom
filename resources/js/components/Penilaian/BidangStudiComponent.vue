<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm p-1 mb-5 bg-white rounded">
                    <div class="card-header text-white bg-dark">
                        <div class="d-flex bd-highlight mb-10">
                            <div class="mr-auto p-2 bd-highlight">
                                <b>Data Bidang Studi</b>
                            </div>
                            <div class="p-2 bd-highlight">
                                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modelId">
                                    <i class="fas fa-plus"></i> Data Baru
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.kode }}</td>
                                    <td>{{ user.nama }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form @submit.prevent="createBidangStudi">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kode</label>
                                <input v-model="form.kode" type="text" name="kode"
                                    placeholder="Masukkan Kode"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('kode') }">
                                <has-error :form="form" field="kode"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input v-model="form.nama" type="text" name="nama"
                                    placeholder="Nama bidang studi"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('nama') }">
                                <has-error :form="form" field="nama"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Tidak Jadi</button>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                users: [],
                form: new Form({
                    kode: '',
                    nama: ''
                })
            }
        },

        created () {
            this.getBidangStudi();
        },

        methods: {
            getBidangStudi () {
                axios.get('/api/bidang-studi')
                .then((res) => {
                    this.users = res.data.data;
                    // console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
            },

            createBidangStudi () {
                this.form.post('/api/bidang-studi')
            }
        },
    }
</script>
