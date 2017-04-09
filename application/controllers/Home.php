<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('site');
		define("__SRC__", base_url('lib') . '/');
		define("__ISRC__", base_url('uploads/images') . '/');
		define("__ST__", 'Brilian Yotanega Site');

		if($this->ion_auth->logged_in())
		{
			define('__ME__', $this->ion_auth->user()->row()->username);
			define('__MYKEY__', $this->ion_auth->user()->row()->mykey);
		}
	}

	public function index($wdyw = null)
	{
			if(!$this->ion_auth->logged_in())
		{
			$data['sitetitle'] 	= __ST__;
			$data['sitesrc']  	= __SRC__;
			$data['isrc']  		= __ISRC__;
			$this->load->view('welcome_message', $data);
		}
			else
		{
			$data['sitesrc']  	= __SRC__;
			$data['sitetitle'] 	= __ST__;
			$data['isrc']  		= __ISRC__;


			$this->db->order_by('date', 'RANDOM');
			$this->db->limit(2);
			$data['twopost'] = $this->db->get_where('users_post',array('ispublish'=>'Y'))->result();

			$this->db->order_by('date', 'RANDOM');
			$this->db->limit(7);
			$data['tofriends'] = $this->db->get_where('users',array('active'=>'1'))->result();
			if($wdyw)
			{
				$this->load->view('part/home', $data);
			}
			else
				$this->load->view('home', $data);
		}
	}

	function background_process()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('wdyw', 'Wdyw', 'trim|required|min_length[1]|max_length[3]');
		if ($this->form_validation->run() == FALSE)
			show_404();
		else
		{

		$wdyw = $this->input->post('wdyw');
		switch ($wdyw) {
			case 1: //login
				$this->form_validation->set_rules('identity', 'Identity', 'trim|required|min_length[3]|max_length[15]');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[15]');
				if ($this->form_validation->run() == FALSE)
					echo 0;
				else 
				{
					$identity = $this->input->post('identity', TRUE);
					$c = $this->db->query("SELECT * FROM users WHERE identity='$identity' LIMIT 1;")->row_array();
					if($c['username'] != $identity && $c['email'] != $identity)
						echo 0;
					else
					{
						$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
						$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

						if ($this->form_validation->run() == TRUE)
						{

							$remember = 0;

							if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
							{

								$valid_user = $this->ion_auth->user()->row();
								//Set userdata
								$this->session->set_userdata('id', $valid_user->id);
								$this->session->set_userdata('username', $valid_user->username);
								$this->session->set_userdata('identity', $valid_user->identity);
								$this->session->set_userdata('email', $valid_user->email);
								$this->session->set_userdata('first_name', $valid_user->first_name);
								$this->session->set_userdata('last_name', $valid_user->last_name);
								$this->session->set_userdata('borndate', $valid_user->borndate);
								$this->session->set_userdata('address', $valid_user->address);
								$this->session->set_userdata('image', $valid_user->image);
								$this->session->set_userdata('mykey', $valid_user->mykey);

								$this->index(1);

								$now 		= date('y-m-d H:i:s');
								$me 		= $valid_user->username;
								$this->db->query("UPDATE users SET last_activity='$now' WHERE username='$me'");
								
								if($this->input->post('logolstatus') == 'on')
									$this->session->set_userdata('logolstatus', 'HIDE');

								if($this->input->post('logmutemode') == 'on')
									$this->session->set_userdata('logmutemode', 'MUTED');

								$me = $valid_user->username;
								if($this->input->post('logremsave') == 'on')
								{
									
									$ip = $this->input->ip_address();
									$bs = $this->input->get_browser();

									$cek = $this->db->query("SELECT * FROM lftp WHERE ip_address='$ip' AND browser='$bs' AND username='$me' LIMIT 1;")->row_array()->username;
									if(empty($cek))
										$this->db->query("INSERT INTO lftp (ip_address,browser,username) VALUES ('$ip','$bs','$me')");

									$this->session->set_userdata('logremsave', $valid_user->mykey);
								}
								else
									$this->db->query("DELETE FROM lftp WHERE username='$me'");

								//redirect(base_url());
							}
							else
							{
								echo 0;
							}
						}
						else
							echo 0;
					}
				}
				break;
			
			case 2: //signup

		        $tables = $this->config->item('tables','ion_auth');

		        $this->form_validation->set_rules('username','','required|is_unique[users.username]');
		        $this->form_validation->set_rules('email', '', 'required|valid_email|is_unique[users.email]');
		        $this->form_validation->set_rules('password', '', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		        $this->form_validation->set_rules('password_confirm', '', 'required');
		        $this->form_validation->set_rules('agreetos', '', 'required|exact_length[2]|in_list[on]');
		        $this->form_validation->set_rules('subscribe', '', 'max_length[3]');

		        if ($this->form_validation->run() == TRUE)
		        {
		            $email    	= strtolower($this->input->input_stream('email', TRUE));
		            $identity 	= strtolower($this->input->input_stream('username', TRUE));
		            $password 	= $this->input->input_stream('password', TRUE);
		            $now 		= date('y-m-d H:i:s');

		            $additional_data = array(
		                'first_name' 	=> $this->input->input_stream('first_name', TRUE),
		                'last_name' 	=> $this->input->input_stream('last_name', TRUE),
		                'last_activity' => $now,
		                'agreetos' 		=> $this->input->input_stream('agreetos', TRUE),
		                'issubscribe' 	=> $this->input->input_stream('subscribe', TRUE)
		            );

		        }

		        if ($this->form_validation->run() == TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data))
		        {
		        	$remember 			= 0;
					$sitesrc 			= base_url('lib') . '/';
		        	$data['sitesrc'] 	= $sitesrc;
		        	
		            if($this->ion_auth->login($identity, $password, $remember))
		            {
						
						$valid_user = $this->ion_auth->user()->row();
						//Set userdata
						$this->session->set_userdata('id', $valid_user->id);
						$this->session->set_userdata('username', $valid_user->username);
						$this->session->set_userdata('identity', $valid_user->identity);
						$this->session->set_userdata('email', $valid_user->email);
						$this->session->set_userdata('first_name', $valid_user->first_name);
						$this->session->set_userdata('last_name', $valid_user->last_name);
						$this->session->set_userdata('borndate', $valid_user->borndate);
						$this->session->set_userdata('address', $valid_user->address);
						$this->session->set_userdata('image', $valid_user->image);
						$this->session->set_userdata('mykey', $valid_user->mykey);

		        		$this->load->view('part/profileeditaftersignup', $data);
		            }
		        }
		        	else
		        {
		        	echo $this->input->input_stream('username', TRUE);
		        }
				break;
			case 3: // last activity
				if(!$this->ion_auth->logged_in())
					show_404();

				$me = $this->ion_auth->user()->row()->username;
				$now = date('y-m-d H:i:s');
				$this->db->query("UPDATE users SET last_activity='$now' WHERE username='$me';");
				break;
			case 4: //check username
				$this->form_validation->set_rules('wdyh','','required|alpha_numeric|max_length[15]|is_unique[users.username]');
				if ($this->form_validation->run() == FALSE)
					echo 'u';
				break;

			case 5: //check email
				$this->form_validation->set_rules('wdyh','','required|valid_email|max_length[20]|is_unique[users.email]');
				if ($this->form_validation->run() == FALSE)
					echo 'u';
				break;

			case 6: //Edit after signup
				$this->form_validation->set_rules('borndate','','required');
				$this->form_validation->set_rules('gender','','required');
				$this->form_validation->set_rules('bio','','required');
				$this->form_validation->set_rules('address','','required');

				if ($this->form_validation->run() == TRUE)
				{
					$bd = $this->input->post('borndate', TRUE);
					$gd = $this->input->post('gender', TRUE);
					$bi = $this->input->post('bio', TRUE);
					$ad = $this->input->post('address', TRUE);


					$config['upload_path'] 			= './uploads/images/';
					$config['allowed_types'] 		= 'gif|jpg|png';
					$config['max_size']  			= '2000';
	                $config['max_width']            = 2024;
	                $config['max_height']           = 2024;
					$config['encrypt_name']			= TRUE;
					$config['remove_spaces']		= TRUE;
					$config['detect_mime']			= TRUE;
					$config['mod_mime_fix']			= TRUE;
					

	                $this->load->library('upload', $config);
					
					if( ! $this->upload->do_upload('userfile'))
						echo 'fail';
					else
					{
						$image = $this->upload->data();
						
						$img 						= $image['file_name'];
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= './uploads/images/' . $img;
						$config['maintain_ratio'] 	= FALSE;
						$config['width']         	= 650;
						$config['height']       	= 650;
						$config['quality']       	= '75%';

						$this->load->library('image_lib', $config);

						$this->image_lib->resize();
						$me = $this->ion_auth->user()->row()->username;
						$this->db->query("UPDATE users SET 
							image='".$this->db->escape_str($img)."'
							,borndate='".$this->db->escape_str($bd)."'
							,gender='".$this->db->escape_str($gd)."'
							,bio='".$this->db->escape_str($bi)."'
							,address='".$this->db->escape_str($ad)."' 
							WHERE username='$me';");
						redirect(base_url());
					}
				}
				else
					echo 'kambing';

				break;
				case 7: //new question
					if(!$this->ion_auth->logged_in())
						show_404();

					$this->form_validation->set_rules('qt','','required');
					$this->form_validation->set_rules('qto','','required');

						if ($this->form_validation->run() == TRUE)
					{
						$qt 	= $this->input->input_stream('qt', TRUE); //title
						$qd 	= $this->input->input_stream('qd', TRUE); //descrription
						$qto 	= $this->input->input_stream('qto', TRUE); //topic
						$qa 	= $this->input->input_stream('qa', TRUE); //address
						$me 	= __ME__;
						$mykey	= $this->ion_auth->user()->row()->mykey;
						$now 	= date('YmdHis');

						$this->db->query("INSERT INTO timeline (type,username,ukey) 
										VALUES ('0','$me','$mykey')");
						$last 	= $this->db->query("SELECT ckey FROM timeline WHERE username='$me' ORDER BY id DESC;")->row()->ckey;

						$this->db->query("INSERT INTO questions (title,content,topic,address,username,ukey,tkey,date) 
										VALUES ('$qt','$qd','$qto','$qa','$me','$mykey','$last','$now');");

						echo 's';
					}
					else
						echo 'f';
					break;
					case 8: // show timeline
					if(!$this->ion_auth->logged_in())
						show_404();

						$me 	= __ME__;
						$mykey	= $this->ion_auth->user()->row()->mykey;
						$who 	= $this->input->input_stream('identity', TRUE);

						if(!$who)
						$tl 	= $this->db->query("SELECT * FROM timeline ORDER BY id DESC")->result();
						else
						$tl 	= $this->db->query("SELECT * FROM timeline WHERE username='$who' AND type='1' ORDER BY id DESC")->result();

						$data['sitetitle'] 		= __ST__;
						$data['sitesrc']  		= __SRC__;
						$data['isrc']	  		= __ISRC__;
						$data['timeline_data'] 	= $tl;
						$this->load->view('part/timeline', $data);

						break;
					case 9: // main search
						
						break;
					case 10: // votes and follow
					if(!$this->ion_auth->logged_in())
						show_404();

						$this->form_validation->set_rules('identity','','required');
						$this->form_validation->set_rules('type','','required');
						if ($this->form_validation->run() == TRUE)
						{
							$type 		= $this->input->input_stream('type', TRUE);
							$identity 	= $this->input->input_stream('identity', TRUE);
							$me 		= __MYKEY__;
							$im 		= __ME__;

							if($type == 'dv')
							{
									//question dv
									$qdv = $this->db->query("SELECT * FROM questions WHERE ckey='$identity' LIMIT 1;")->row();
									if(!empty($qdv))
									{
										$tkey 	= $qdv->tkey;

										$qv 	= $this->db->query("SELECT * FROM questions_votes WHERE ukey='$me' AND qkey='$identity' AND status='0' LIMIT 1;")->row();
										if(empty($qv))
										{
											$this->db->query("INSERT INTO questions_votes (qkey,tkey,username,ukey,status) VALUES ('$identity','$tkey','$im','$me','0')");
											$count 	= $this->db->query("SELECT * FROM questions_votes WHERE qkey='$identity' AND status='0';")->num_rows();
											echo 's'.$count;
										}
										else
										{
											$this->db->query("DELETE FROM questions_votes WHERE qkey='$identity' AND username='$im' AND ukey='$me' AND status='0';");
											$count 	= $this->db->query("SELECT * FROM questions_votes WHERE qkey='$identity' AND status='0';")->num_rows();
											echo 'f'.$count;
										}
									}
							}
							elseif($type == 'ad' || $type == 'ad-m' || $type == 'ad-aj')
							{
								$ad = $this->db->query("SELECT * FROM answers WHERE ckey='$identity' LIMIT 1;")->row();
								if(!empty($ad))
								{
									$qkey = $ad->ckey; //question key
									$cek = $this->db->query("SELECT * FROM answers_votes WHERE akey='$identity' AND username='$im' AND ukey='$me' AND status='0' LIMIT 1;")->row();
									if(empty($cek))
									{
										$this->db->query("INSERT INTO answers_votes (qkey,akey,username,ukey,status) VALUES ('$qkey','$identity','$im','$me','0')");
										$count = $this->db->query("SELECT * FROM answers_votes WHERE qkey='$qkey' AND akey='$identity' AND status='0'")->num_rows();
										echo 's'.$count;
									}
									else
									{
										$this->db->query("DELETE FROM answers_votes WHERE qkey='$qkey' AND akey='$identity' AND username='$im' AND ukey='$me' AND status='0'");
										$count = $this->db->query("SELECT * FROM answers_votes WHERE qkey='$qkey' AND akey='$identity' AND status='0'")->num_rows();
										echo 'f'.$count;
									}
								}
							}
							elseif($type == 'al' || $type == 'al-m' || $type == 'al-aj')
							{
								$ad = $this->db->query("SELECT * FROM answers WHERE ckey='$identity' LIMIT 1;")->row();
								if(!empty($ad))
								{
									$qkey = $ad->ckey; //question key
									$cek = $this->db->query("SELECT * FROM answers_votes WHERE akey='$identity' AND username='$im' AND ukey='$me' AND status='2' LIMIT 1;")->row();
									if(empty($cek))
									{
										$this->db->query("INSERT INTO answers_votes (qkey,akey,username,ukey,status) VALUES ('$qkey','$identity','$im','$me','2')");
										$count = $this->db->query("SELECT * FROM answers_votes WHERE qkey='$qkey' AND akey='$identity' AND status='2'")->num_rows();
										echo 's'.$count;
									}
									else
									{
										$this->db->query("DELETE FROM answers_votes WHERE qkey='$qkey' AND akey='$identity' AND username='$im' AND ukey='$me' AND status='2'");
										$count = $this->db->query("SELECT * FROM answers_votes WHERE qkey='$qkey' AND akey='$identity' AND status='2'")->num_rows();
										echo 'f'.$count;
									}
								}
							}
							elseif($type == 'fl')
							{

									$qfl = $this->db->query("SELECT * FROM log_follow WHERE identity='$identity' AND username='$im' AND ukey='$me' AND log_info='3' LIMIT 1;")->row();

									$q 		= $this->db->query("SELECT * FROM questions WHERE ckey='$identity' LIMIT 1;")->row();
									$tkey 	= $q->tkey;

									if(empty($qfl))
									{
										$this->db->query("INSERT INTO log_follow (identity,tkey,username,ukey,last_user,log_info)
														VALUES ('$identity','$tkey','$im','$me','$im','3')");
										$this->db->query("UPDATE log_follow SET last_user='$im' WHERE identity='$identity' AND tkey='$tkey' AND username!='$im' AND log_info='3';");
										$count = $this->db->query("SELECT * FROM log_follow WHERE identity='$identity' AND tkey='$tkey' AND log_info='3';")->num_rows();
										echo 's'.$count;
									}
									else
									{
										$this->db->query("DELETE FROM log_follow WHERE identity='$identity' AND tkey='$tkey' AND username='$im' AND ukey='$me';");
										$count = $this->db->query("SELECT * FROM log_follow WHERE identity='$identity' AND tkey='$tkey' AND log_info='3';")->num_rows();
										echo 'f'.$count;
									}
							}
						}
						break;
						case 11: //load q & a modals
						if(!$this->ion_auth->logged_in())
							show_404();

							$this->form_validation->set_rules('identity','','required|alpha_numeric');
							$this->form_validation->set_rules('type','','required|alpha|exact_length[1]');
							if ($this->form_validation->run() == TRUE)
							{
								$me 	= __ME__;
								$mykey	= $this->ion_auth->user()->row()->mykey;
								$now 	= date('YmdHis');
								$ckey 	= $this->input->input_stream('identity', TRUE);
								$type 	= $this->input->input_stream('type', TRUE);

								if($type == 'q')
								{
									$dataQ 	= $this->db->query("SELECT * FROM questions WHERE ckey='".$this->db->escape_str($ckey)."' LIMIT 1;")->row();
									$data['question'] 	= $dataQ;
									$data['type'] 		= 'q';
									$data['sitesrc']  	= __SRC__;
									$data['me']  		= __MYKEY__;
									$data['isrc']  		= __ISRC__;
									$this->load->view('part/qa_modal', $data);
								}
								elseif($type == 'a')
								{
									$dataA 	= $this->db->query("SELECT * FROM answers WHERE ckey='".$this->db->escape_str($ckey)."' LIMIT 1;")->row();
									$data['answer'] 	= $dataA;
									$data['type'] 		= 'a';
									$data['sitesrc']  	= __SRC__;
									$data['me']  		= __MYKEY__;
									$data['isrc']  		= __ISRC__;
									$this->load->view('part/qa_modal', $data);
								}
							}
							break;
						case 12: //send comment & answer
						if(!$this->ion_auth->logged_in())
							show_404();

							$this->form_validation->set_rules('identity','','required');
							$this->form_validation->set_rules('content','','required');
							$this->form_validation->set_rules('type','','required');
							if ($this->form_validation->run() == TRUE)
							{
								$me 	= __ME__;
								$mykey	= $this->ion_auth->user()->row()->mykey;
								$ckey 	= $this->input->input_stream('identity', TRUE);
								$type 	= $this->input->input_stream('type', TRUE);
								$content= $this->input->input_stream('content', TRUE);

								if($type == 'new-a-btn')
								{
									$this->db->query("INSERT INTO timeline (type,username,ukey) 
													VALUES ('1','$me','$mykey')");
									$last 	= $this->db->query("SELECT ckey FROM timeline WHERE username='$me' AND type='1' ORDER BY id DESC;")->row()->ckey;
									$this->db->query("INSERT INTO answers (qkey,content,username,ukey,tkey) VALUES ('".$this->db->escape_str($ckey)."','".$this->db->escape_str($content)."','$me','$mykey','$last')");
									echo 's';
/*									$la = $this->db->query("SELECT * FROM answers WHERE username='$me' AND ukey='$mykey' ORDER BY id DESC LIMIT 1;")->row()->qkey;
									$lt = $this->db->query("SELECT * FROM questions WHERE ckey='$la->qkey' LIMIT 1;")->row();*/

/*									$qfl = $this->db->query("SELECT * FROM log_follow WHERE identity='$ckey' AND username='$im' AND ukey='$me' AND log_info='3' LIMIT 1;")->row();

									$q 		= $this->db->query("SELECT * FROM questions WHERE ckey='$ckey' LIMIT 1;")->row();
									$tkey 	= $q->tkey;

									if(empty($qfl))
									{
										$this->db->query("INSERT INTO log_follow (identity,tkey,username,ukey,last_user,log_info)
														VALUES ('$ckey','$tkey','$im','$me','$im','3')");
										$this->db->query("UPDATE log_follow SET last_user='$im' WHERE identity='$ckey' AND tkey='$tkey' AND username!='$im' AND log_info='3';");
										$count = $this->db->query("SELECT * FROM log_follow WHERE identity='$ckey' AND tkey='$tkey' AND log_info='3';")->num_rows();
										echo 's'.$count;
									}
									else
									{
										$this->db->query("DELETE FROM log_follow WHERE identity='$ckey' AND tkey='$tkey' AND username='$im' AND ukey='$me';");
										$count = $this->db->query("SELECT * FROM log_follow WHERE identity='$ckey' AND tkey='$tkey' AND log_info='3';")->num_rows();
										echo 'f'.$count;
									}*/
								}
								elseif($type == 'new-c-btn')
								{
									$this->db->query("INSERT INTO questions_comments (qkey,content,username,ukey) VALUES ('".$this->db->escape_str($ckey)."','".$this->db->escape_str($content)."','$me','$mykey')");
									echo 's';
								}
							}	
								else
									echo 'f';
							break;
							case 13: //answer and comment for questions modals & comment for a
							if(!$this->ion_auth->logged_in())
								show_404();

								$this->form_validation->set_rules('identity','','required');
								$this->form_validation->set_rules('type','','required');
								if ($this->form_validation->run() == TRUE)
								{
									$identity 	= $this->input->input_stream('identity', TRUE);
									$type 		= $this->input->input_stream('type', TRUE);
									switch ($type) {
										case 0: //load komentar pertanyaan .comment-quest
											  $c  = $this->db->query("SELECT * FROM questions_comments WHERE qkey='".$this->db->escape_str($identity)."';")->result();
											  $data['c'] = $c;
											  $data['sitesrc'] = __SRC__;
											  $data['isrc'] = __ISRC__;
											  $this->load->view('part/comment_question', $data);
											break;
										case 1: //load jawaban pertanyaan .answer-quest
											  $c  = $this->db->query("SELECT * FROM answers WHERE qkey='".$this->db->escape_str($identity)."';")->result();
											  $data['answers'] = $c;
											  $data['sitesrc'] = __SRC__;
											  $data['isrc'] = __ISRC__;
											  $this->load->view('part/answer_in_modal', $data);
											break;
										case 2: //load komentar jawaban
											
											break;
										default:
											# code...
											break;
									}
								}
								break;
							case 14: //Delete
							if(!$this->ion_auth->logged_in())
								show_404();

								$this->form_validation->set_rules('identity','','required');
								$this->form_validation->set_rules('type','','required');
								if ($this->form_validation->run() == TRUE)
								{
									$me 	= __ME__;
									$mykey	= $this->ion_auth->user()->row()->mykey;
									$type 	  = $this->input->input_stream('type', TRUE);
									$identity = $this->input->input_stream('identity', TRUE);

									switch ($type) {
										case 0: //delete answer
											$cek = $this->db->query("SELECT * FROM answers WHERE username='$me' AND ukey='$mykey' AND ckey='$identity' LIMIT 1;")->row();
											if(!empty($cek))
											{
												$tkey = $cek->tkey;
												//delete timeline
												$this->db->query("DELETE FROM timeline WHERE ckey='$tkey' AND username='$me' AND ukey='$mykey' AND type='1';");
												//delete answer comment
												$this->db->query("DELETE FROM answers_comments WHERE akey='$identity' AND username='$me' AND ukey='$mykey';");
												//delete answer comment
												$this->db->query("DELETE FROM answers_comments_reply WHERE akey='$identity' AND username='$me' AND ukey='$mykey';");
												//delete answer
												$this->db->query("DELETE FROM answers WHERE username='$me' AND ukey='$mykey' AND ckey='$identity';");
												echo 's';
											}
											break;
										case 1:	//delete comment in answer
											$cek = $this->db->query("SELECT * FROM answers_comments WHERE ckey='$identity' AND username='$me' AND ukey='$mykey' LIMIT 1;")->row();
											if(!empty($cek))
											{
												$this->db->query("DELETE FROM answers_comments WHERE ckey='$identity' AND username='$me' AND ukey='$mykey'");
												echo 's';
											}
											break;
										case 2: //delete comment in question 
											
											break;
										
										default:
											# code...
											break;
									}
								}
								break;
							case 15: //post answer comment & reply
							if(!$this->ion_auth->logged_in())
								show_404();

								$this->form_validation->set_rules('identity','','required');
								$this->form_validation->set_rules('type','','required');
								$this->form_validation->set_rules('content','','required');
								if ($this->form_validation->run() == TRUE)
								{
									$me 	= __ME__;
									$mykey	= $this->ion_auth->user()->row()->mykey;
									$type 	  = $this->input->input_stream('type', TRUE);
									$identity = $this->input->input_stream('identity', TRUE);
									$content  = $this->input->input_stream('content', TRUE);

									if($type == '0') //post comment
									{
										$this->db->query("INSERT INTO answers_comments (akey,content,username,ukey) VALUES ('$identity','$content','$me','$mykey')");
									}
									elseif($type == '1') //post reply
									{
										$getcans = $this->db->query("SELECT * FROM answers_comments WHERE ckey='$identity' LIMIT 1;")->row();

										$this->db->query("INSERT INTO answers_comments_reply (ackey,akey,content,username,ukey) VALUES ('$identity','$getcans->akey','$content','$me','$mykey')");
									}
								}
								break;
							case 16: //load comment & reply
							if(!$this->ion_auth->logged_in())
								show_404();

								$this->form_validation->set_rules('identity','','required');
								$this->form_validation->set_rules('type','','required');
								if ($this->form_validation->run() == TRUE)
								{
									$me 	= __ME__;
									$mykey	= $this->ion_auth->user()->row()->mykey;
									$type 	  = $this->input->input_stream('type', TRUE);
									$identity = $this->input->input_stream('identity', TRUE);

									if($type == '0') // load comment (answer)
									{
										$cdata = $this->db->query("SELECT * FROM answers_comments WHERE akey='$identity' ORDER BY id DESC;")->result();
										$data['comments'] = $cdata;
										$data['sitesrc'] = __SRC__;
										$data['isrc'] = __ISRC__;
										$this->load->view('part/answer_comment', $data);
									}
									elseif($type == '1') //load reply (load reply)
									{
										$rdata = $this->db->query("SELECT * FROM answers_comments_reply WHERE ackey='$identity' ORDER BY id DESC;")->result();
										$data['replys'] = $rdata;
										$data['sitesrc'] = __SRC__;
										$data['isrc'] 	= __ISRC__;
										$data['key'] 	= $identity; 
										$this->load->view('part/answer_comment_reply', $data);
									}
								}
								break;
								case 17: // whoactwhat, [CREATE] for answer comment & comment reply
								if(!$this->ion_auth->logged_in())
									show_404();

									$this->form_validation->set_rules('identity','','required');
									$this->form_validation->set_rules('type','','required');
									if ($this->form_validation->run() == TRUE)
									{
										$type = $this->input->input_stream('type', TRUE);
										$identity = $this->input->input_stream('identity', TRUE);
										$now 	= date('YmdHis');
										if($type == '0') //act on commment'in annswer
										{
											$cek = $this->db->query("SELECT * FROM whoactwhat WHERE type='$type' AND ckey='$identity'")->row();
											if(empty($cek))
											{
												$this->db->query("INSERT INTO whoactwhat (type,ckey,date) VALUES ('$type','$identity','$now')");
												echo 't';
											}
											else
											{
												$this->db->query("UPDATE whoactwhat SET date='$now' WHERE type='$type' AND ckey='$identity'");
												echo 't';
											}
										}
									}
									break;
								case 18: //is doing something act?
								if(!$this->ion_auth->logged_in())
									show_404();

									$this->form_validation->set_rules('identity','','required');
									$this->form_validation->set_rules('type','','required');
									if ($this->form_validation->run() == TRUE)
									{
										$type = $this->input->input_stream('type', TRUE);
										$identity = $this->input->input_stream('identity', TRUE);
										$now 	= date('YmdHis', mktime( date('H'),date('i'),date('s') - 2,date('m'),date('d'),date('Y')));

										if($type == 0) //act on commment'in annswer
										{
											$cek = $this->db->query("SELECT * FROM whoactwhat WHERE type='0' AND ckey='$identity' AND date > '$now' LIMIT 1;")->row();
											if(empty($cek))
												echo '0';
											else
												echo '1';
										}
									}
									break;
								case 19: //do follow user
								if(!$this->ion_auth->logged_in())
									show_404();

									$this->form_validation->set_rules('identity','','required');
									$this->form_validation->set_rules('username','','required');
									if ($this->form_validation->run() == TRUE)
									{
										$username = $this->input->input_stream('username', TRUE);
										$identity = $this->input->input_stream('identity', TRUE);
										$me 	  = __ME__;
										$im 	  = __MYKEY__;
										if($identity == $im)
											die();

										$cek = $this->db->query("SELECT * FROM users_follow WHERE followed_username='$username' AND followed_ukey='$identity' AND username='$me' AND ukey='$im' LIMIT 1;")->row();
										if(empty($cek))
										{
											$this->db->query("INSERT INTO users_follow (followed_username,followed_ukey,username,ukey) VALUES ('$username','$identity','$me','$im');");
											$count = $this->db->query("SELECT * FROM users_follow WHERE followed_username='$username' AND followed_ukey='$identity';")->num_rows();
											echo 'f'.$count;
										}
										else
										{
											$this->db->query("DELETE FROM users_follow WHERE followed_username='$username' AND followed_ukey='$identity' AND username='$me' AND ukey='$im';");
											$count = $this->db->query("SELECT * FROM users_follow WHERE followed_username='$username' AND followed_ukey='$identity';")->num_rows();
											echo 'u'.$count;
										}
									}
									break;
								case 20: // get something for profile

									$this->form_validation->set_rules('identity','','required'); //wdyh
									$this->form_validation->set_rules('username','','required'); //wdyh2
									$this->form_validation->set_rules('dow','','required'); //p1
									if ($this->form_validation->run() == TRUE)
									{
										$ukey  	 	= $this->input->input_stream('identity', TRUE);
										$username 	= $this->input->input_stream('username', TRUE);
										$do 	 	= $this->input->input_stream('dow', TRUE);
										$data['sitesrc']  		= __SRC__;
										$data['isrc']	  		= __ISRC__;
										if($do == '0') //answer
										{
											$tl = $this->db->query("SELECT * FROM timeline WHERE username='$username' AND type='1' ORDER BY id DESC")->result();
											$data['timeline_data'] = $tl;
											$data['sw'] 		   = 'tl';
											$this->load->view('part/profile_timeline', $data);
										}
										elseif($do == '1') //question
										{
											$tl = $this->db->query("SELECT * FROM timeline WHERE username='$username' AND type='0' ORDER BY id DESC")->result();
											$data['timeline_data'] = $tl;
											$data['sw'] 		   = 'tl';
											$this->load->view('part/profile_timeline', $data);
										}
										elseif($do == '2') //post
										{
											$tl = $this->db->query("SELECT * FROM users_post WHERE username='$username' AND ukey='$ukey' ORDER BY id DESC")->result();
											$data['post_data'] 		= $tl;
											$data['sw'] 		    = 'pt';
											$this->load->view('part/profile_timeline', $data);
										}
										elseif($do == '3') //meeting [coming soon]
										{

										}
										elseif($do == '4') //following
										{
											$tl = $this->db->query("SELECT * FROM users_follow WHERE username='$username' AND ukey='$ukey' ORDER BY id DESC")->result();
											$data['u_data'] 		= $tl;
											$data['sw'] 		    = 'fg';
											$this->load->view('part/profile_timeline', $data);
										}
										elseif($do == '5') //Followers
										{
											$tl = $this->db->query("SELECT * FROM users_follow WHERE followed_username='$username' AND followed_ukey='$ukey' ORDER BY id DESC")->result();
											$data['u_data'] 		= $tl;
											$data['sw'] 		    = 'fs';
											$this->load->view('part/profile_timeline', $data);
										}
										elseif($do == '6') //Followers
										{
											$tl = $this->db->query("SELECT * FROM users_topics WHERE username='$username' AND ukey='$ukey' ORDER BY id DESC")->result();
											$data['t_data'] 		= $tl;
											$data['sw'] 		    = 'tp';
											$this->load->view('part/profile_timeline', $data);
										}
									}
									break;
					case 21:
					if(!$this->ion_auth->logged_in())
						show_404();

					$this->form_validation->set_rules('qt','','required');
					$this->form_validation->set_rules('qd','','required');
					$this->form_validation->set_rules('qp','','required');
					$this->form_validation->set_rules('fu','','required');
					$this->form_validation->set_rules('fk','','required');
					$this->form_validation->set_rules('identity','','required');

						if ($this->form_validation->run() == TRUE)
					{
						$qt 	= $this->input->input_stream('qt', TRUE); //title
						$qd 	= $this->input->input_stream('qd', TRUE); //description
						$qp 	= $this->input->input_stream('qp', TRUE); //topic
						$fu 	= $this->input->input_stream('fu', TRUE); //topic
						$fk 	= $this->input->input_stream('fk', TRUE); //topic
						$id 	= $this->input->input_stream('identity', TRUE); //ckey question
						$me 	= __ME__;
						$mykey	= $this->ion_auth->user()->row()->mykey;

						$this->db->query("INSERT INTO questions_edits (qkey,title,content,topic,username,ukey,for_username,for_ukey) 
										VALUES ('$id','$qt','$qd','$qp','$me','$mykey','$fu','$fk');");
						echo 's';
					}
						break;

					case 22: //get and edit post
					if(!$this->ion_auth->logged_in())
						show_404();

						$this->form_validation->set_rules('identity','','required');
						$this->form_validation->set_rules('type','','required');

						$identity = $this->input->input_stream('identity', TRUE);
						$type 	  = $this->input->input_stream('type', TRUE);
						$me 	  = __ME__;
						$ukey 	  = __MYKEY__;

						if($type == '0')
						{
							$data['tt']   = '0';
							$this->load->view('part/post_form', $data);
						}
						else
						{
							$cek = $this->db->query("SELECT * FROM users_post WHERE ckey='$identity' AND username='$me' AND ukey='$ukey' LIMIT 1;")->row();
							if(!empty($cek))
							{
								$data['tt']   = '1';
								$data['post'] = $cek;
								$this->load->view('part/post_form', $data);
							}

						}
						break;
					case 23:
					if(!$this->ion_auth->logged_in())
						show_404();
					$this->form_validation->set_rules('df','',''); //dynamic filter (search input)
					
					if ($this->form_validation->run() == TRUE)
					{
						$data['sitesrc'] = __SRC__;
						$data['isrc'] 	= __ISRC__;
						$mainstaticfilter = $this->input->input_stream('sf', TRUE);
						$topic = $this->input->input_stream('tp', TRUE);
						$dynamicsearch = $this->input->input_stream('df', TRUE);

						if(empty($dynamicsearch))
						{
							$timeline_data = $this->db->query("SELECT * FROM timeline ORDER BY id DESC LIMIT 20;")->result();
							$data['timeline_data'] = $timeline_data;
							$data['tt'] 		   = 0;
							$this->load->view('part/explore_content', $data);
						}
						else
						{
							$timeline_data = $this->db->query("SELECT * FROM timeline WHERE  ORDER BY id DESC LIMIT 20;")->result();
							$data['timeline_data'] = $timeline_data;
							$data['tt'] 		   = 0;
							$this->load->view('part/explore_content', $data);
						}
					}

						break;
			default:
				# code...
				break;
			}
		}

	}

	function profiledetail()
	{
		// if(!$this->ion_auth->logged_in())
		// 	show_404();

		$identity 	= $this->uri->segment(2);
		$pid 	 	= str_replace('/!/i', '', $identity);
		$npid 		= strtolower($pid);
		$udata 		= $this->db->query("SELECT * FROM users WHERE username='$identity' LIMIT 1;")->row();
		$data['sitesrc']  	= __SRC__;
		$data['isrc']  		= __ISRC__;
		if(!empty($udata))
		{
			$data['profile']  	= $udata;
			$this->load->view('profiledetail', $data);
		}
		else
			show_404();
	}

	function questiondetail()
	{
		$identity 	= $this->uri->segment(2);
		$pid 	 	= str_replace('/!/i', '', $identity);
		$qdata 		= $this->db->query("SELECT * FROM timeline WHERE ckey='$pid' AND type='0' LIMIT 1;")->row();
		$data['sitesrc']  	= __SRC__;
		$data['isrc']  		= __ISRC__;
		$data['fw'] 		= 'qs';
		$lastview 			= $qdata->viewer;
		$nowview 			= $lastview+1;
		if($this->session->userdata('ltq') != $identity)
			$this->db->query("UPDATE timeline SET viewer='$nowview' WHERE ckey='$pid'");

		if(!empty($qdata))
		{
			$data['timeline']  = $qdata;
			$this->load->view('detail', $data);
		}
		else
			show_404();
	}

	function answerdetail()
	{
		$identity 	= $this->uri->segment(2);
		$pid 	 	= str_replace('/!/i', '', $identity);
		$qdata 		= $this->db->query("SELECT * FROM timeline WHERE ckey='$pid' AND type='1' LIMIT 1;")->row();
		$data['sitesrc']  	= __SRC__;
		$data['isrc']  		= __ISRC__;
		$data['fw'] 		= 'aw';
		if(!empty($qdata))
		{
			$data['timeline']  = $qdata;
			$this->load->view('detail', $data);
		}
		else
			show_404();
	}

	function userpost()
	{
		$me = __ME__;
		$ukey = __MYKEY__;
		$data['sitesrc']  	= __SRC__;
		$data['isrc']  		= __ISRC__;
		$data['post_data'] = $this->db->query("SELECT * FROM users_post WHERE username='$me' AND ukey='$ukey' ORDER BY id DESC")->result();
		$this->load->view('posts', $data);
	}

	function savepost()
	{

					$this->load->library('form_validation');
		if(!$this->input->post('ckey')){
					$this->form_validation->set_rules('title','','required');
					$this->form_validation->set_rules('url','','required');
					$this->form_validation->set_rules('description','','required');
					$this->form_validation->set_rules('content','','required');

					if ($this->form_validation->run() == TRUE)
					{

						$config['upload_path'] 			= './uploads/images/';
						$config['allowed_types'] 		= 'gif|jpg|png';
						$config['max_size']  			= '2000';
		                $config['max_width']            = 2024;
		                $config['max_height']           = 2024;
						$config['encrypt_name']			= TRUE;
						$config['remove_spaces']		= TRUE;
						$config['detect_mime']			= TRUE;
						$config['mod_mime_fix']			= TRUE;
						

		                $this->load->library('upload', $config);
						
						if( ! $this->upload->do_upload('mainimage'))
							echo 'fail';

						$title 		 = $this->input->post('title', TRUE);
						$url 		 = $this->input->post('url', TRUE);
						$description = $this->input->post('description', TRUE);
						$content  	 = $this->input->post('content', TRUE);
						
						$imagedata 	 = $this->upload->data();
						$image 		 = $imagedata['file_name'];
						$me 		 = __ME__;
						$mykey 		 = __MYKEY__;
						$this->db->query("INSERT INTO users_post (title,url,image,description,content,username,ukey)
										VALUES ('$title','$url','$image','$description','$content','$me','$mykey');");
						redirect('my-post');
					}
		}
	}
	function editpost()
	{
		$this->load->library('form_validation');
		if($this->input->post('title'))
		{					
			$this->form_validation->set_rules('title','','required');
			$this->form_validation->set_rules('url','','required');
			$this->form_validation->set_rules('description','','required');
			$this->form_validation->set_rules('content','','required');

			$config['upload_path'] 			= './uploads/images/';
			$config['allowed_types'] 		= 'gif|jpg|png';
			$config['max_size']  			= '2000';
		    $config['max_width']            = 2024;
		    $config['max_height']           = 2024;
			$config['encrypt_name']			= TRUE;
			$config['remove_spaces']		= TRUE;
			$config['detect_mime']			= TRUE;
			$config['mod_mime_fix']			= TRUE;

			$title 		 = $this->input->post('title', TRUE);
			$url 		 = $this->input->post('url', TRUE);
			$description = $this->input->post('description', TRUE);
			$content  	 = $this->input->post('content', TRUE);
			$ckey 	  	 = $this->uri->segment(3);
			$me 		 = __ME__;
			$mykey 		 = __MYKEY__;
						
			$cek = $this->db->query("SELECT * FROM users_post WHERE ckey='$ckey' AND username='$me' AND ukey='$mykey' LIMIT 1;")->row();
			if(!empty($cek))
			{					
			    $this->load->library('upload', $config);
							
				if( ! $this->upload->do_upload('mainimage'))
					echo 'fail';

				$imagedata 	 = $this->upload->data();
				$nimage = $imagedata['file_name'];

				$toeditimg 					= $nimage;
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= './uploads/images/' . $toeditimg;
				$config['maintain_ratio'] 	= FALSE;
				$config['width']         	= 1200;
				$config['height']       	= 350;
				$config['quality']       	= '75%';

				$this->load->library('image_lib', $config);

				$this->image_lib->resize();

				if(!empty($nimage))
				{
					$todel = $cek->image;
					unlink('./uploads/images/' . $todel);
					$this->db->query("UPDATE users_post SET title='$title',url='$url',image='$nimage',description='$description',content='$content' WHERE username='$me' AND ukey='$mykey' AND ckey='$ckey';");
				}
				else
				{
					$this->db->query("UPDATE users_post SET title='$title',url='$url',description='$description',content='$content' WHERE username='$me' AND ukey='$mykey' AND ckey='$ckey';");
				}

				redirect('my-post');
			}
				else
				redirect('my-post');
		}
		else
		{
			$ckey 	  	 = $this->uri->segment(3);
			$me 		 = __ME__;
			$ukey 		 = __MYKEY__;

			$cek = $this->db->query("SELECT * FROM users_post WHERE ckey='$ckey' AND username='$me' AND ukey='$ukey' LIMIT 1;")->row();
			if(!empty($cek))
			{
				$data['tt']   = '1';
				$data['post'] = $cek;
				$this->load->view('edit_post', $data);
			}
		}
	}

	function read_post()
	{
		$identity = $this->uri->segment(3);
		$writer   = $this->uri->segment(2);

		$nurl = str_replace('/!/!', '', $identity);
		$get = $this->db->query("SELECT * FROM users_post WHERE url='".$this->db->escape_str($identity)."' AND username='".$this->db->escape_str($writer)."' LIMIT 1;")->row();
		if(empty($get))
			show_404();

		$lastview = $get->viewer;
		$nowview  = $lastview+1;

		if($this->session->userdata('lastwatchedpost') != $writer.'/'.$identity)
			$this->db->query("UPDATE users_post SET viewer='$nowview' WHERE url='".$this->db->escape_str($identity)."' AND username='".$this->db->escape_str($writer)."'");

		$data['post'] = $get;
		$data['writer']  	= $this->db->query("SELECT * FROM users WHERE username='".$this->db->escape_str($writer)."';")->row();
		$data['sitesrc']  	= __SRC__;
		$data['isrc']  		= __ISRC__;
		$this->load->view('read_post', $data);
	}

	function explore()
	{
		$data['sitesrc']  	= __SRC__;
		$data['isrc']  		= __ISRC__;
		$this->load->view('explore', $data);
	}

	function logout()
	{
		// log the user out
		$logout = $this->ion_auth->logout();
		redirect('home', 'refresh');
	}

}
