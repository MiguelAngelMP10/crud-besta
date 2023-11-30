<?= $this->extend('default') ?>


<?= $this->section('content') ?>
    <script src="<?= base_url('js/people/main.js') ?>"></script>
    <div class="container mt-3">
        <?php if (session()->has('success')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h2>People List</h2>

        <button type="button" class="btn btn-outline-primary" onclick="openModal()">
            Add Person
        </button>

        <!-- Modal -->
        <div class="modal fade" id="person-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add new person</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="last-name" class="form-label fw-bold">Last name</label>
                            <input type="text" class="form-control" id="last-name">
                        </div>
                        <div class="mb-3">
                            <label for="middle-name" class="form-label fw-bold">Middle name</label>
                            <input type="text" class="form-control" id="middle-name">
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label fw-bold">Age</label>
                            <input type="number" class="form-control" id="age">
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label fw-bold">Gender</label>
                            <select class="form-select" id="gender">
                                <?php foreach ($genders as $gender): ?>
                                    <option value="<?= $gender['id'] ?>"><?= $gender['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save-person">Save people</button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Middle Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th colspan="2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($people as $person) : ?>
                <tr>
                    <td><?= $person->id ?></td>
                    <td><?= $person->name ?></td>
                    <td><?= $person->last_name ?></td>
                    <td><?= $person->middle_name ?></td>
                    <td><?= $person->age ?></td>
                    <td><?= $person->gender_id . ' ' . $person->gender_name ?></td>
                    <td>
                        <button onclick="editPerson(<?= $person->id ?>)"
                                class="btn btn-outline-info">
                            Edit
                        </button>
                    </td>
                    <td>
                        <?php if (is_null($person->deleted_at)): ?>
                            <a href="<?= site_url('people/delete/' . $person->id) ?>" class="btn btn-outline-danger"
                               onclick="return confirm('Are you sure you want to delete this person?')">Delete</a>
                        <?php else: ?>
                            <a href="<?= site_url('people/restore/' . $person->id) ?>" class="btn btn-outline-warning"
                               onclick="return confirm('Are you sure you want to restore this person?')">Restore</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


<?= $this->endSection() ?>