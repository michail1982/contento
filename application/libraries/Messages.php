<?php
/**
 * @name		CodeIgniter Message Library
 * @author		Jens Segers
 * @link		http://www.jenssegers.be
 * @license		MIT License Copyright (c) 2012 Jens Segers
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages {
    private $ci;

    function __construct($params = array()) {
        $this->ci = & get_instance();
        $this->ci->load->library('session');
    }

    function clear() {
		$this->ci->session->unset_userdata('messages');
    }

    function add($message, $type = 'message') {
    	if (empty($message)) return;
        $messages = $this->ci->session->userdata('messages');
        if (!is_array($messages)) {
            $messages = array();
        }

        if (is_a($message, 'Exception')) {
            $message = $message->getMessage();
            $type = 'error';
        }
        $messages[] = array(
          	'message' => $message,
           	'type' => $type
        );
        $this->ci->session->set_userdata('messages', $messages);
    }

    function count() {
        $messages = $this->ci->session->userdata('messages');
        if (!is_array($messages)) {
            $messages = array();
        }
        return count($messages[$type]);
    }

    function get() {
        $messages = $this->ci->session->userdata('messages');
        if (!is_array($messages)) {
            $messages = array();
        }
        $this->clear();
        return $messages;
    }
}