<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('aboutUs'); // akcja/ścieżka domyślna
App::getRouter()->setLoginRoute('login'); // akcja/ścieżka na potrzeby logowania (przekierowanie, gdy nie ma dostępu)

Utils::addRoute('loginShow',       'LoginCtrl');
Utils::addRoute('login',           'LoginCtrl');
Utils::addRoute('logout',          'LoginCtrl');

Utils::addRoute('aboutUs',         'AboutUsCtrl');
Utils::addRoute('catalog',         'CatalogCtrl');
Utils::addRoute('ajaxSearchBooks',         'CatalogCtrl');

Utils::addRoute('registerShow',    'RegisterCtrl');
Utils::addRoute('register',        'RegisterCtrl');

Utils::addRoute('rent',             'RentCtrl');

Utils::addRoute('rentHistory',      'RentHistoryCtrl', ['Administrator', 'Bibliotekarz', 'Użytkownik']);

Utils::addRoute('employeeRents',    'RentManagementCtrl', ['Administrator', 'Bibliotekarz']);
Utils::addRoute('updateRentStatus', 'RentManagementCtrl', ['Administrator', 'Bibliotekarz']);

Utils::addRoute('employeeUsers',           'UserManagementCtrl', ['Administrator', 'Bibliotekarz']);
Utils::addRoute('addUser',                 'UserManagementCtrl', ['Administrator', 'Bibliotekarz']);

Utils::addRoute('userEdit', 'UserEditCtrl', ['Administrator', 'Bibliotekarz']);
Utils::addRoute('userSave', 'UserEditCtrl', ['Administrator', 'Bibliotekarz']);
Utils::addRoute('displayUsers', 'UserEditCtrl', ['Administrator', 'Bibliotekarz']);