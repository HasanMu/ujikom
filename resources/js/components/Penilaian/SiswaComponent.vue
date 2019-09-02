<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm p-1 mb-5 bg-white rounded">
                    <div class="card-header text-white bg-dark">
                        <div class="d-flex bd-highlight mb-10">
                            <div class="mr-auto p-2 bd-highlight">
                                <b>Data Siswa</b>
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
                                    <th scope="col">NISN</th>
                                    <th scope="col">Nama Kompetensi</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="kk in kompkeah" :key="kk.id">
                                    <td>{{ kk.kode }}</td>
                                    <td>{{ kk.bidangstudi.nama }}</td>
                                    <td>{{ kk.nama }}</td>
                                    <td>
                                        <a href="javascript:void(0)" @click="editModal(kk)" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                         /
                                        <a href="javascript:void(0)" @click="deleteBidangStudi(kk.id)" data-toggle="tooltip" title="Hapus Data" style="color: red;">
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
                    <form @submit.prevent="editMode ? updateKompKeah() : createKompKeah()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>NISN</label>
                                <input v-model="form.nisn" type="text" name="nisn"
                                    placeholder="Masukkan NISN"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('nisn') }">
                                <has-error :form="form" field="nisn"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Nama Kompetensi</label>
                                <select v-model="form.kompetensi_id" name="kompetensi_id"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('kompetensi_id') }">

                                    <option v-for="bd in kompetensi_keahlian" :key="bd.id" :value="bd.id">
                                    {{ bd.nama }}
                                    </option>

                                </select>
                                <has-error :form="form" field="kompetensi_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input v-model="form.nama" type="text" name="nama"
                                    placeholder="Nama bidang studi"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('nama') }">
                                <has-error :form="form" field="nama"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea v-model="form.alamat" type="text" name="alamat"
                                    placeholder="Alamat"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('alamat') }"></textarea>
                                <has-error :form="form" field="alamat"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input v-model="form.tgl_lahir" type="date" name="tgl_lahir"
                                    placeholder="tgl_lahir bidang studi"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('tgl_lahir') }">
                                <has-error :form="form" field="tgl_lahir"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input v-model="form.foto" type="text" name="foto"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('foto') }">
                                <has-error :form="form" field="foto"></has-error>
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
                siswa: [],
                kompetensi_keahlian: [],
                editMode: true,
                form: new Form({
                    id: '',
                    nisn: '',
                    kompetensi_id: '',
                    nama: '',
                    alamat: '',
                    tgl_lahir: '',
                    foto: '',
                })
            }
        },

        created () {
            this.getSiswa();
            this.getKompKeah();
            Fire.$on('afterCreate', () => {
                this.getSiswa();
                this.getKompKeah();
            });
        },

        methods: {
            // Mendapatkan semua data kompetensi keahlian
            getSiswa () {
                axios.get('/api/siswa')
                .then((res) => {
                    this.kompkeah = res.data;
                    // console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
            },

            // Mendapatkan semua data bidang studi
            getKompKeah () {
                axios.get('/api/kompetensi-keahlian')
                .then((res) => {
                    this.kompetensi_keahlian = res.data;
                    console.log(res);

                })
                .catch((err) => {
                    console.log(err);
                })
            },

            // Menampilkan modal tambah data
            addModal() {
                this.form.clear();
                this.editMode = false;
                this.form.reset();
                $('.modal-title').html('Tambah Data');
                $('#modal').modal('show');
            },

            // Mengirim permintaan untuk tambah data
            createKompKeah () {
                this.$Progress.start();
                this.form.post('/api/kompetensi-keahlian')
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

            // Menampilkan modal edit data
            editModal(data) {
                this.form.clear();
                this.editMode = true;
                this.form.reset();
                $('.modal-title').html('Edit Data');
                $('#modal').modal('show');
                this.form.fill(data);
            },

            // Mengirim permintaan untuk ubah data
            updateKompKeah(id) {
                // console.log('Update bidang studi');
                this.form.put('/api/kompetensi-keahlian/'+this.form.id)
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

            // Mengirim permintaan untuk ubah data
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
                        this.form.delete('/api/kompetensi-keahlian/'+id)
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
