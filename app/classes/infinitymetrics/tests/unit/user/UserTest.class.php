<?php
/**
 * $Id: UserTest.class.php 202 2008-11-10 21:31:40Z marcellosales $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITYs, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the Berkeley Software Distribution (BSD).
 * For more information please see <http://ppm-8.dev.java.net>.
 */
require_once 'PHPUnit/Framework.php';
require_once 'infinitymetrics/model/user/User.class.php';
/**
 * Tests for the User class.
 *
 * @author Marcello de Sales <marcello.sales@gmail.com>
 */
class UserTest extends PHPUnit_Framework_TestCase {

    private $user;
    
    const USERNAME = "marcellosales";

    protected function setUp() {
        parent::setUp();
        $this->user = new User("Marcello", "de Sales", self::USERNAME);
    }

    public function testUserCreation() {
        $this->assertEquals("Marcello", $this->user->getFirstName(), "The value of the name is in incorrect");
        $this->assertEquals("de Sales", $this->user->getLastName(), "The user's last name is in incorrect state");
        $this->assertEquals(self::USERNAME, $this->user->getUsername(), "The user's username is in incorrect state");
    }

    public function testUserUpdate() {
        $this->user->setFirstName("Gurdeep");
        $this->user->setLastName("Singh");
        $this->assertEquals("Gurdeep", $this->user->getFirstName(), "The value of the name is in incorrect");
        $this->assertEquals("Singh", $this->user->getLastName(), "The value of the name is in incorrect");
    }
    
    protected function tearDown() {
        $this->user = null;
    }
}
?>
