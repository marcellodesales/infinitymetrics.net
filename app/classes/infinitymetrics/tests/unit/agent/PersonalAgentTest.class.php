<?php
/**
 * $Id: PersonalAgentTest.class.php 202 2008-11-10 21:31:40Z marcellosales $
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
require_once 'propel/Propel.php';
Propel::init('infinitymetrics/orm/config/om-conf.php');

require_once 'PHPUnit/Framework.php';
require_once 'infinitymetrics/model/user/PersonalAgent.class.php';
require_once 'infinitymetrics/model/institution/Student.class.php';
/**
 * Tests for the Personal Agent class.
 *
 * @author Marcello de Sales <marcello.sales@gmail.com>
 */
class PersonalAgentTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Student|Instructor|User is the instance of a java.net User.
     */
    private $user;
    /**
     * @var PersonalAgent is the instance of the PersonalAgent that will represent the User.
     */
    private $agent;
    
    const USERNAME = "marcellosales";
    const PASSWORD = "utn@9oad";

    protected function setUp() {
        parent::setUp();
        $this->user = new Student();
        $this->user->setFirstName("Marcello");
        $this->user->setLastName("de Sales");
        $this->user->setEmail("marcello.sales@gmail.com");
        $this->user->setJnUsername(self::USERNAME);
        $this->user->setJnPassword(self::PASSWORD);

        $this->agent = new PersonalAgent($this->user);
    }

    /**
     * Verify if the personal agent is created for the given user
     */
    public function testPersonalAgentCreation() {
//        echo "Testing Agent Creation";
        $this->assertNotNull($this->agent, "The agent was not created");
        $this->assertTrue($this->agent->getUser()->equals($this->user), "The user in the agent is not the same as used
              during creation.");
        $this->assertTrue($this->agent->getUser()->isStudent(), "The user in the agent is not a regular
        Java.net user");
    }
    /**
     * Verify the in-memory PersonalAgent instances
     */
    public function testPeronalAgentComparison() {
//        echo "Testing Agent Comparison";
        $a = new PersonalAgent($this->user);
        $b = $this->agent;
        $this->assertTrue($b === $this->agent, "The reference of the 2 agents MUST be the same");
        $this->assertTrue($b !== $a, "The references must be different");
        $this->assertTrue($a->equals($this->agent), "The agents must be equals because they are from the same user");
        $this->assertTrue($b->equals($a), "The agents must be the same because they are references to the same object");
        $this->assertTrue($a instanceof PersonalAgent, "The agent instance must be of class PersonalAgent");
        $this->assertTrue($b instanceof PersonalAgent, "The agent instance reference must of class PersonalAgent");
    }
    
    protected function tearDown() {
        $this->user = null;
        $this->agent = null;
    }
}
?>
