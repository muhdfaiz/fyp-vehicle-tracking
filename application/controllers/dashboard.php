<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Dashboard extends CI_Controller
    {
        public function admin_profile()
        {
            if ($this->session->userdata('logged_in') == TRUE) {

                $this->load->model('dashboard_model');
                // User Data
                $data['firstname'] = $this->dashboard_model->readDataByRow('admin', 'firstname');
                $data['lastname'] = $this->dashboard_model->readDataByRow('admin', 'lastname');
                $data['email'] = $this->dashboard_model->readDataByRow('admin', 'email');
                $data['phone'] = $this->dashboard_model->readDataByRow('admin', 'telephone');

                $this->load->view('dashboard_header', $data);
                $this->load->view('dashboard_profile', $data);
                $this->load->view('dashboard_footer');
            }
            else
            {
                redirect(base_url(). 'login');
            }
        }

        public function update_admin_profile()
        {
            $this->load->model('dashboard_model');
            $userInfo = array(
                'firstname' => $_POST['firstname1'],
                'lastname' => $_POST['lastname1'],
                'email' => $_POST['email1'],
                'telephone' => $_POST['phone1'],
            );
            if(isset($userInfo['firstname']) && isset($userInfo['lastname']) && isset($userInfo['email']) && isset($userInfo['telephone']))
            {
                $id = $this->session->userdata('admin_id');
                $this->dashboard_model->updateData('admin', $userInfo, 'admin_id', $id);
                echo 'Your Profile Information Update Was Successful!';
            }
            else
            {
                echo 'Your Profile Information failed to update!';
            }
        }

        public function update_admin_password()
        {
            $this->load->library('encrypt');
            $this->load->model('dashboard_model');
            $hash = $this->encrypt->sha1($_POST['oldPassword1']);
            $oldHash = $this->dashboard_model->comparePasswordHash();
            $newPassword = $this->encrypt->sha1($_POST['newPassword2']);
            if($hash !== $this->dashboard_model->comparePasswordHash())
            {
                echo "Your current password not match with the previous password!";
            }
            else
            {
                $userInfo = array(
                    'hash' => $newPassword,
                );
                if(isset($userInfo['hash']))
                {
                    $id = $this->session->userdata('admin_id');
                    $this->dashboard_model->updateData('user', $userInfo, 'admin_id', $id);
                    echo 'Your Profile Information Update Was Successful!';
                }
                else
                {
                    echo 'Your Profile Information failed to update!';
                }
            }
        }

        public function user()
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                $this->load->model('dashboard_model');

                $data['firstname'] = $this->dashboard_model->readDataByRow('admin', 'firstname');
                $data['lastname'] = $this->dashboard_model->readDataByRow('admin', 'lastname');
                $data['listUser'] = $this->dashboard_model->readAllData('user');

                $this->load->view('dashboard_header', $data);
                $this->load->view('dashboard_user', $data);
                $this->load->view('dashboard_footer');
            }
            else
            {
                redirect(base_url(). 'login');
            }

        }

        public function add_new_user()
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                $this->load->model('dashboard_model');
                $userInfo = array(
                    'firstname' => $_POST['firstname1'],
                    'lastname' => $_POST['lastname1'],
                    'ic_number' => $_POST['icNo1'],
                    'address' => $_POST['address1'],
                    'user_phone_no' => $_POST['phone2'],
                    'relative_phone_no' => $_POST['phone1'],
                    'day_used' => $_POST['days1'],
                    'device_number' => $_POST['device1'],
                    'status' => 'active',
                );

                if(isset($userInfo['firstname']) && isset($userInfo['lastname']) && isset($userInfo['ic_number']) && isset($userInfo['address']) && isset($userInfo['relative_phone_no']) && isset($userInfo['user_phone_no']) && isset($userInfo['day_used']) && isset($userInfo['device_number']))
                {
                    $this->dashboard_model->addData('user', $userInfo);
                    echo 'User Information Was Added Into Your Profile!'; ?>
                <?php }
                else
                {
                    echo 'Vehicle Information Failed To Added Into Your Profile!';
                }
            }
            else
            {
                redirect(base_url(). 'login');
            }
        }

        public function update_user($id)
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                $this->load->model('dashboard_model');

                $data['userId'] = $id;
                $data['firstname'] = $this->dashboard_model->readDataFilter1('user_id', $data['userId'], 'user', 'firstname');
                $data['lastname'] = $this->dashboard_model->readDataFilter1('user_id', $data['userId'], 'user', 'lastname');
                $data['ic_number'] = $this->dashboard_model->readDataFilter1('user_id', $data['userId'], 'user', 'ic_number');
                $data['address'] = $this->dashboard_model->readDataFilter1('user_id', $data['userId'], 'user', 'address');
                $data['user_phone_no'] = $this->dashboard_model->readDataFilter1('user_id', $data['userId'], 'user', 'user_phone_no');
                $data['relative_phone_no'] = $this->dashboard_model->readDataFilter1('user_id', $data['userId'], 'user', 'relative_phone_no');
                $data['day_used'] = $this->dashboard_model->readDataFilter1('user_id', $data['userId'], 'user', 'day_used');
                $data['device_number'] = $this->dashboard_model->readDataFilter1('user_id', $data['userId'], 'user', 'device_number');
                 if($_POST)
                {
                    $userInfo = array(
                        'firstname' => $_POST['firstname1'],
                        'lastname' => $_POST['lastname1'],
                        'ic_number' => $_POST['icNo1'],
                        'address' => $_POST['address1'],
                        'user_phone_no' => $_POST['phone2'],
                        'relative_phone_no' => $_POST['phone1'],
                        'day_used' => $_POST['days1'],
                        'device_number' => $_POST['device1'],
                    );

                    if(isset($userInfo['firstname']) && isset($userInfo['lastname']) && isset($userInfo['ic_number']) && isset($userInfo['address']) && isset($userInfo['user_phone_no']) && isset($userInfo['relative_phone_no']) && isset($userInfo['day_used']) && isset($userInfo['device_number']))
                    {
                        $this->dashboard_model->updateData('user', $userInfo, 'user_id' ,$data['userId']);
                        echo 'User Information Was Updated!';
                    }
                    else
                    {
                        echo 'User Information Failed To Update!';
                    }
                }

                $this->load->view('dashboard_update_user', $data);
            }
            else
            {
                redirect(base_url(). 'login');
            }
        }

        public function delete_user()
        {
            $userId = $_POST['user_id1'];
            $this->load->model('dashboard_model');
            $this->dashboard_model->deleteData('user', 'user_id', $userId);
            echo "Vehicle Succesfully Delete";
        }

        public function user_status()
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                $this->load->model('dashboard_model');
                $data['firstname'] = $this->dashboard_model->readDataByRow('admin', 'firstname');
                $data['lastname'] = $this->dashboard_model->readDataByRow('admin', 'lastname');
                $data['listUser'] = $this->dashboard_model->readAllData('user');

                $this->load->view('dashboard_header', $data);
                $this->load->view('dashboard_user_status', $data);
                $this->load->view('dashboard_footer');
            }
            else
            {
                redirect(base_url(). 'login');
            }
        }

        public function update_user_status($status)
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                $this->load->model('dashboard_model');
                $query = $this->dashboard_model->readDataFilter('status', $status, 'user');
                //echo $this->db->last_query();

                if($query->num_rows()>0)
                { ?>
                    <div class="user-list col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-bus"></i>List Of User
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Status</th>
                                            <th>Device No</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>IC Number</th>
                                            <th>Relative Phone No</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($query->result() as $row)
                                        { ?>
                                            <tr>
                                                <td><?php if ($row->status == 'inactive') { ?>
                                                        <span id="setActive" class="label label-sm label-info">Set Active</span>
                                                    <?php }
                                                    else
                                                    { ?>
                                                        <span id="setInactive" class="label label-sm label-warning">Set Inactive</span>
                                                    <?php }?>

                                                    <div style="display: none;" class='userId'><?php echo $row->user_id; ?></div>
                                                </td>
                                                <td><?php echo $row->status; ?></td>
                                                <td><?php echo $row->device_number; ?></td>
                                                <td><?php echo $row->firstname; ?></td>
                                                <td><?php echo $row->lastname; ?></td>
                                                <td><?php echo $row->ic_number; ?></td>
                                                <td><?php echo $row->phone_no; ?></td>
                                            </tr>
                                        <?php }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                    </div>
                <?php }
                else
                {
                    if($status == 'active') { ?>
                        <script>alert('Not Have Active User Today')</script>
                    <?php }
                    else if ($status == 'inactive')
                    { ?>
                        <script>alert('Not Have Inactive User Today')</script>
                    <?php }

                }
            }
            else
            {
                redirect(base_url(). 'login');
            }
        }

        public function update_user_status1()
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                $this->load->model('dashboard_model');
                $query = $this->dashboard_model->readAllData('user');
                //echo $this->db->last_query();

                if($query->num_rows()>0)
                { ?>
                    <div class="user-list col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-bus"></i>List Of User
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Status</th>
                                            <th>Device No</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>IC Number</th>
                                            <th>Relative Phone No</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($query->result() as $row)
                                        { ?>
                                            <tr>
                                                <td><?php if ($row->status == 'inactive') { ?>
                                                        <span id="setActive" class="label label-sm label-info">Set Active</span>
                                                    <?php }
                                                    else
                                                    { ?>
                                                        <span id="setInactive" class="label label-sm label-warning">Set Inactive</span>
                                                    <?php }?>

                                                    <div style="display: none;" class='userId'><?php echo $row->user_id; ?></div>
                                                </td>
                                                <td><?php echo $row->status; ?></td>
                                                <td><?php echo $row->device_number; ?></td>
                                                <td><?php echo $row->firstname; ?></td>
                                                <td><?php echo $row->lastname; ?></td>
                                                <td><?php echo $row->ic_number; ?></td>
                                                <td><?php echo $row->phone_no; ?></td>
                                            </tr>
                                        <?php }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                    </div>
                <?php }
                else
                { ?>
                    <script>alert('Not Have Any User')</script>
                <?php }
            }
            else
            {
                redirect(base_url(). 'login');
            }
        }

        public function set_user_status($status)
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                $this->load->model('dashboard_model');
                if($_POST)
                {
                    $data['user_id'] = $_POST['user_id1'];
                    $userStatus = array(
                        'status' => $status,
                    );
                    $this->dashboard_model->updateData('user', $userStatus, 'user_id' ,$data['user_id']);
                }
            }
            else
            {
                redirect(base_url(). 'login');
            }
        }

        public function track_user()
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                $this->load->model('dashboard_model');
                $data['firstname'] = $this->dashboard_model->readDataByRow('admin', 'firstname');
                $data['lastname'] = $this->dashboard_model->readDataByRow('admin', 'lastname');
                $data['listActiveUser'] = $this->dashboard_model->readDataFilter('status', 'active', 'user');

                $this->load->view('dashboard_header', $data);
                $this->load->view('dashboard_track', $data);
                $this->load->view('dashboard_footer');
            }
            else
            {
                redirect(base_url(). 'login');
            }
        }

        public function view_route()
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                $this->load->model('dashboard_model');
                $data['firstname'] = $this->dashboard_model->readDataByRow('admin', 'firstname');
                $data['lastname'] = $this->dashboard_model->readDataByRow('admin', 'lastname');
                $data['listUser'] = $this->dashboard_model->readAllData('user');
                $this->load->view('dashboard_header', $data);
                $this->load->view('dashboard_route', $data);
                $this->load->view('dashboard_footer');
            }
            else
            {
                redirect(base_url(). 'login');
            }
        }

        public function view_report()
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                $this->load->model('dashboard_model');
                $id = $this->session->userdata('user_id');
                $data['firstname'] = $this->dashboard_model->readDataByRow('admin', 'firstname');
                $data['lastname'] = $this->dashboard_model->readDataByRow('admin', 'lastname');
                $data['listUser'] = $this->dashboard_model->readAllData('user');
                $this->load->view('dashboard_header', $data);
                $this->load->view('dashboard_report', $data);
                $this->load->view('dashboard_footer');

            }
            else
            {
                redirect(base_url(). 'login');
            }
        }
    }