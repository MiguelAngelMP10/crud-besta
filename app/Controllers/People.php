<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Gender;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use ReflectionException;

class People extends BaseController
{
    public function index(): string
    {
        $peopleModel = new \App\Models\People();
        $data = [
            'people' => $data['people'] = $peopleModel
                ->withDeleted()
                ->join('gender', 'people.gender_id = gender.id', 'left')
                ->select('people.*, gender.name as gender_name')
                ->findAll(),
            'genders' => (new Gender())->findAll()
        ];

        return view('people/index', $data);
    }

    public function createOrEdit(): ResponseInterface
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $last_name = $this->request->getPost('last_name');
        $middle_name = $this->request->getPost('middle_name');
        $age = $this->request->getPost('age');
        $gender_id = $this->request->getPost('gender_id');

        $peopleModel = new \App\Models\People();
        $peopleModel->callProcedureSaveOrUpdatePerson($id, $name, $last_name, $middle_name, $age, $gender_id);
        return $this->response->setJSON(['status' => true, 'message' => 'Datos guardados con éxito']);
    }

    public function show($id = null): ResponseInterface
    {
        $peopleModel = new \App\Models\People();

        $people = $peopleModel->withDeleted()->join('gender', 'people.gender_id = gender.id', 'left')
            ->select('people.*, gender.name as gender_name')->find($id);

        return $this->response->setJSON(['status' => isset($people), 'data' => $people]);
    }

    public function delete($id): RedirectResponse
    {
        $peopleModel = new \App\Models\People();
        $peopleModel->delete($id);

        return redirect()->to('/people')->with('success', 'Registro eliminado suavemente.');
    }

    /**
     * @throws ReflectionException
     */
    public function restore($id): RedirectResponse
    {
        $peopleModel = new \App\Models\People();
        $peopleModel->where('id', $id)
            ->set([
                'deleted_at' => null,
            ])
            ->update();
        return redirect()->to('/people')->with('success', 'Registro restaurado.');
    }
}
