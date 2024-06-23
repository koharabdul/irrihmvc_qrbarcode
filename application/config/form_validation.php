<?php 
$config = array(
	'groups' => array(
		 array(
            'field' => 'name',
            'label' => 'Name',
            // 'rules' => 'required|trim|min_length[3]|is_unique[t_groups.name]',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
            	'required' => 'The %s field is required.',
                // 'is_unique' => 'The %s field must contain a unique value.',
            ),
        ),
        array(
            'field' => 'landing_page',
            'label' => 'Landing Page',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
            	'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'pages[]',
            'label' => 'Pages',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
            	'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
            	'required' => 'The %s field is required.',
            ),
        )

	),
    'pages' => array(
         array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|trim|min_length[3]',
            // 'rules' => 'required|trim|min_length[3]|is_unique[t_pages.name]',
            'errors' => array(
                'required' => 'The %s field is required.',
                // 'is_unique' => 'The %s field must contain a unique value.',
            ),
        ),
        array(
            'field' => 'uri',
            'label' => 'Uri Segment',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'group[]',
            'label' => 'Groups',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        )

    ),
    'users/insert' => array(
        array(
            'field' => 'nik',
            'label' => 'NIK',
            'rules' => 'required|trim|min_length[3]|max_length[16]|numeric|is_unique[t_users.NIK]',
            'errors' => array(
                // 'required' => 'The %s field is required.',
                'is_unique' => 'The %s field must contain a unique value.',
            ),
        ),
        array(
            'field' => 'nm_lengkap',
            'label' => 'Nama Lengkap',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'tmp_lahir',
            'label' => 'Tempat Lahir',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'tgl_lahir',
            'label' => 'Tanggal Lahir',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'jns_kelamin',
            'label' => 'Tanggal Lahir',
            'rules' => 'required|trim',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'agama',
            'label' => 'Agama',
            'rules' => 'required|trim',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'sts_perkawinan',
            'label' => 'Status Perkawinan',
            'rules' => 'required|trim',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'pendidikan',
            'label' => 'Pendidikan Terakhir',
            'rules' => 'required|trim',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'pekerjaan',
            'label' => 'Pekerjaan',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
    ),
    'provinsi/save' => array(
        array(
            'field' => 'nama_provinsi',
            'label' => 'Nama Provinsi',
            'rules' => 'required|trim|min_length[3]|is_unique[t_provinsi.provinsi]',
            'errors' => array(
                'required' => 'The %s field is required.',
                'is_unique' => 'The %s field must contain a unique value.',
            ),
        ),
    ),
    'provinsi/update' => array(
        array(
            'field' => 'nama_provinsi',
            'label' => 'Nama Provinsi',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
    ),
    'kabupaten/save' => array(
        array(
            'field' => 'nama_kabupaten',
            'label' => 'Nama Kabupaten',
            'rules' => 'required|trim|min_length[3]|is_unique[t_provinsi.provinsi]',
            'errors' => array(
                'required' => 'The %s field is required.',
                'is_unique' => 'The %s field must contain a unique value.',
            ),
        ),
        array(
            'field' => 'provinsi_id',
            'label' => 'Nama Provinsi',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
    ),
    'kabupaten/update' => array(
        array(
            'field' => 'nama_kabupaten',
            'label' => 'Nama Kabupaten',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'provinsi_id',
            'label' => 'Nama Provinsi',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
    ),
    'kecamatan/save' => array(
        array(
            'field' => 'nama_kecamatan',
            'label' => 'Nama Kecamatan',
            'rules' => 'required|trim|min_length[3]|is_unique[t_provinsi.provinsi]',
            'errors' => array(
                'required' => 'The %s field is required.',
                'is_unique' => 'The %s field must contain a unique value.',
            ),
        ),
        array(
            'field' => 'kabupaten_id',
            'label' => 'Nama Kabupaten',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
    ),
    'kecamatan/saves' => array(
        array(
            'field' => 'nama_kecamatan',
            'label' => 'Nama Kecamatan',
            'rules' => 'required|trim|min_length[3]|is_unique[t_provinsi.provinsi]',
            'errors' => array(
                'required' => 'The %s field is required.',
                'is_unique' => 'The %s field must contain a unique value.',
            ),
        ),
        array(
            'field' => 'kabupaten_id',
            'label' => 'Nama Kabupaten',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
    ),
    'kecamatan/update' => array(
        array(
            'field' => 'nama_kecamatan',
            'label' => 'Nama Kecamatan',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'kabupaten_id',
            'label' => 'Nama Kabupaten',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
    ),
    'kelurahan/save' => array(
        array(
            'field' => 'provinsi_id',
            'label' => 'Nama Provinsi',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'kabupaten_id',
            'label' => 'Nama Kabupaten',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'kecamatan_id',
            'label' => 'Nama Kecamatan',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'type_kelurahan',
            'label' => 'Type Kelurahan',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'nama_kelurahan',
            'label' => 'Nama Kelurahan',
            'rules' => 'required|trim|min_length[3]|is_unique[t_kelurahan.kelurahan]',
            'errors' => array(
                'required' => 'The %s field is required.',
                'is_unique' => 'The %s field must contain a unique value.',
            ),
        ),
    ),
    'kelurahan/saves' => array(
        array(
            'field' => 'provinsi_id',
            'label' => 'Nama Provinsi',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'kabupaten_id',
            'label' => 'Nama Kabupaten',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'kecamatan_id',
            'label' => 'Nama Kecamatan',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'type_kelurahan',
            'label' => 'Type Kelurahan',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        // array(
        //     'field' => 'nama_kelurahan',
        //     'label' => 'Nama Kelurahan',
        //     'rules' => 'required|trim|min_length[3]|is_unique[t_kelurahan.kelurahan]',
        //     'errors' => array(
        //         'required' => 'The %s field is required.',
        //         'is_unique' => 'The %s field must contain a unique value.',
        //     ),
        // ),
    ),
    'kelurahan/update' => array(
        array(
            'field' => 'kecamatan_id',
            'label' => 'Nama Kecamatan',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'type_kelurahan',
            'label' => 'Type Kelurahan',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
        array(
            'field' => 'nama_kelurahan',
            'label' => 'Nama Kelurahan',
            'rules' => 'required|trim|min_length[3]',
            'errors' => array(
                'required' => 'The %s field is required.',
            ),
        ),
    ),

);
?>