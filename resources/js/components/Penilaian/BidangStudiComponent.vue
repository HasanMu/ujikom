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
                                <button type="button" class="btn btn-light btn-sm" @click="addModal()">
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
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.kode }}</td>
                                    <td>{{ user.nama }}</td>
                                    <td>
                                        <a href="javascript:void(0)" @click="editModal(user)" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                         /
                                        <a href="javascript:void(0)" @click="deleteBidangStudi(user.id)" data-toggle="tooltip" title="Hapus Data" style="color: red;">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form @submit.prevent="editMode ? updateBidangStudi() : createBidangStudi()">
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
                            <button v-show="!editMode" type="submit" class="btn btn-success">Tambah</button>
                            <button v-show="editMode" type="submit" class="btn btn-primary">Edit</button>
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
                editMode: true,
                form: new Form({
                    id: '',
                    kode: '',
                    nama: ''
                })
            }
        },

        created () {
            this.getBidangStudi();
            Fire.$on('afterCreate', () => {
                this.getBidangStudi();
            });
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

            addModal() {
                this.editMode = false;
                this.form.reset();
                $('.modal-title').html('Tambah Data');
                $('#modal').modal('show');
            },

            createBidangStudi () {
                this.$Progress.start();
                this.form.post('/api/bidang-studi')
                .then((res) => {
                    Fire.$emit('afterCreate');
                    $('#modal').modal('hide');
                    this.$Progress.finish();
                    Swal.fire(
                        'Berhasil!',
                        res.data.message,
                        'success'
                    )
                })
                .catch((err) => {
                    // Swal.fire({
                    //     type: 'error',
                    //     title: 'Upss...',
                    //     text: 'Sepertinya ada sesuatu yang salah!',
                    // });
                    console.log(err);
                })
            },

            editModal(data) {
                this.editMode = true;
                this.form.reset();
                $('.modal-title').html('Edit Data');
                $('#modal').modal('show');
                this.form.fill(data);
            },

            updateBidangStudi(id) {
                // console.log('Update bidang studi');
                this.form.put('/api/bidang-studi/'+this.form.id)
                .then((res) => {
                    Fire.$emit('afterCreate');
                    $('#modal').modal('hide');
                    this.$Progress.finish();
                    Swal.fire(
                        'Berhasil!',
                        res.data.message,
                        'success'
                    )
                })
                .catch((err) => {
                    console.log(err);
                })
            },

            deleteBidangStudi(id) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data akan dihapus permanen!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Tidak jadi'
                    }).then((result) => {
                    if (result.value) {
                        this.$Progress.start();
                        this.form.delete('/api/bidang-studi/'+id)
                        .then((res) => {
                            Swal.fire(
                                'Berhasil!',
                                res.data.message,
                                'success'
                            );
                            Fire.$emit('afterCreate');
                            this.$Progress.finish();
                            // console.log(res);

                        })
                        .catch((err) => {
                            Swal.fire({
                                type: 'error',
                                title: 'Upss...',
                                text: 'Sepertinya ada sesuatu yang salah!',
                            });
                            console.log(err);
                        })

                    }
                })
            }
        },
    }
</script>
