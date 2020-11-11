<?php


/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */



namespace Kernel\Classes\Data\Objects;


interface UserToObjectimpl
{
    public function Initialize($USER_ID);

    public function Save();
}