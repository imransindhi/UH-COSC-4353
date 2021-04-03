<?php

include "./InputValidator.php";
use PHPUnit\Framework\TestCase;

class InputValidatorTest extends TestCase
{
    public function test1()
    {
        // arrange
        $target = new InputValidator();
        $excepted = 'John Doe';

        // act
        $actual = $target->test_input(' John Doe ');

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test2()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "John O reilly";

        // act
        $actual = $target->test_input(" John O\ reilly ");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test3()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "John Doe";

        // act
        $actual = $target->test_input(" John Doe\ ");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test4()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "John Doe&lt;";

        // act
        $actual = $target->test_input(" John Doe<");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test5()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "John Doe&gt;";

        // act
        $actual = $target->test_input(" John Doe> ");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test6()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "Zipcode can not be below 5 charcters!";

        // act
        $actual = $target->zip_code_tester("1234");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test7()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "Zipcode can not exceed 9 charcters!";

        // act
        $actual = $target->zip_code_tester("12345678910");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test8()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "City can not exceed 100 charcters!";

        // act
        $actual = $target->city_tester("Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean ma");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test9()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "";

        // act
        $actual = $target->city_tester("Houston");

        // assert
        $this->assertEquals($excepted, $actual);
    }


    public function test10()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "Address 2 can not exceed 100 charcters!";

        // act
        $actual = $target->address_2_tester("Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean ma");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    
    public function test11()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "";

        // act
        $actual = $target->address_2_tester("Universisty of Houston");

        // assert
        $this->assertEquals($excepted, $actual);
    }


    public function test12()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "Address 1 can not exceed 100 charcters!";

        // act
        $actual = $target->address_1_tester("Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean ma");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    
    public function test13()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "";

        // act
        $actual = $target->address_1_tester("Universisty of Houston");

        // assert
        $this->assertEquals($excepted, $actual);
    }


    public function test14()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "Only letters and white space allowed";

        // act
        $actual = $target->name_tester("John Joe $");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test15()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "Full name can not exceed 50 charcters!";

        // act
        $actual = $target->name_tester("Lorem ipsum dolor sit amet, consectetuer adipiscing");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test16()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "";

        // act
        $actual = $target->name_tester("John Doe");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test17()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "473 Hedge Street";

        // act
        $actual = $target->getUserAddress("2");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test18()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "University of Houston";

        // act
        $actual = $target->getUserAddress("1");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test19()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "3605 Polk Street";

        // act
        $actual = $target->getUserAddress("3");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test20()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "true";

        // act
        $actual = $target->validateLoginWithEncrptedPassword("asd", "asd");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test21()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "true";

        // act
        $actual = $target->validateLoginWithEncrptedPassword("imran", "imran");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test22()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "false";

        // act
        $actual = $target->validateLoginWithEncrptedPassword("imran", "sindhi");

        // assert
        $this->assertEquals($excepted, $actual);
    }

    public function test23()
    {
        // arrange
        $target = new InputValidator();
        $excepted = "false";

        // act
        $actual = $target->validateLoginWithEncrptedPassword("ASD", "ASD");

        // assert
        $this->assertEquals($excepted, $actual);
    }
}
