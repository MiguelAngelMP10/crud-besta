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
        <h2><?= lang('person_messages.title_list'); ?></h2>

        <button type="button" class="btn btn-outline-primary" onclick="openModal()">
            <?= lang('person_messages.add_person'); ?>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="person-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5"
                            id="exampleModalLabel"><?= lang('person_messages.add_person'); ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold"><?= lang('person_messages.name'); ?></label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="last-name"
                                   class="form-label fw-bold"><?= lang('person_messages.last_name'); ?></label>
                            <input type="text" class="form-control" id="last-name">
                        </div>
                        <div class="mb-3">
                            <label for="middle-name"
                                   class="form-label fw-bold"><?= lang('person_messages.middle_name'); ?></label>
                            <input type="text" class="form-control" id="middle-name">
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label fw-bold"><?= lang('person_messages.age'); ?></label>
                            <input type="number" class="form-control" id="age">
                        </div>
                        <div class="mb-3">
                            <label for="puesto" class="form-label fw-bold"><?= lang('person_messages.job'); ?></label>
                            <input type="text" class="form-control" id="puesto">
                        </div>

                        <div class="mb-3">
                            <label for="gender"
                                   class="form-label fw-bold"><?= lang('person_messages.gender'); ?></label>
                            <select class="form-select" id="gender">
                                <?php foreach ($genders as $gender): ?>
                                    <option value="<?= $gender['id'] ?>"><?= $gender['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal"><?= lang('crud_labels.cancel'); ?></button>
                        <button type="button" class="btn btn-primary"
                                id="save-person"><?= lang('crud_labels.save'); ?></button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
            <tr>
                <th><?= lang('person_messages.id'); ?></th>
                <th><?= lang('person_messages.name'); ?></th>
                <th><?= lang('person_messages.last_name'); ?></th>
                <th><?= lang('person_messages.middle_name'); ?></th>
                <th><?= lang('person_messages.age'); ?></th>
                <th><?= lang('person_messages.gender'); ?></th>
                <th><?= lang('person_messages.job'); ?></th>
                <th colspan="2"><?= lang('crud_labels.actions'); ?></th>
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
                    <td><?= $person->puesto ?></td>
                    <td>
                        <button onclick="editPerson(<?= $person->id ?>)"
                                class="btn btn-outline-info">
                            <?= lang('crud_labels.edit'); ?>
                        </button>
                    </td>
                    <td>
                        <?php if (is_null($person->deleted_at)): ?>
                            <a href="<?= site_url('people/delete/' . $person->id) ?>" class="btn btn-outline-danger"
                               onclick="return confirm('Are you sure you want to delete this person?')"><?= lang('crud_labels.delete'); ?></a>
                        <?php else: ?>
                            <a href="<?= site_url('people/restore/' . $person->id) ?>" class="btn btn-outline-warning"
                               onclick="return confirm('Are you sure you want to restore this person?')"><?= lang('crud_labels.restore'); ?></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


<?= $this->endSection() ?>