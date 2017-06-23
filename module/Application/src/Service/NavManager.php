<?php
namespace Application\Service;

/**
 * This service is responsible for determining which items should be in the main menu.
 * The items may be different depending on whether the user is authenticated or not.
 */
class NavManager
{

    private $authService;
    

    private $urlHelper;
    

    public function __construct($authService, $urlHelper) 
    {
        $this->authService = $authService;
        $this->urlHelper = $urlHelper;
    }
    

    public function getMenuItems() 
    {
        $url = $this->urlHelper;
        $items = [];
        
        $items[] = [
            'id' => 'home',
            'label' => 'Home',
            'link'  => $url('home')
        ];
        
        $items[] = [
            'id' => 'about',
            'label' => 'About',
            'link'  => $url('about')
        ];

        if (!$this->authService->hasIdentity()) {

            $items[] = [
                'id' => 'login',
                'label' => 'Sign in',
                'link'  => $url('login'),
                'float' => 'right',
                'dropdown' => [
                    [
                        'id' => 'login',
                        'label' => 'Sign in',
                        'link'  => $url('login'),

                     ],
                    [
                        'id' => 'register',
                        'label' => 'Register',
                        'link'  => $url('users', ['action'=>'add']),

                    ]
                ]

            ];
        } else {
            
            $items[] = [
                'id' => 'Users',
                'label' => 'Users',
                'dropdown' => [
                    [
                        'id' => 'users',
                        'label' => 'Manage Users',
                        'link' => $url('users')
                    ]
                ]
            ];
            
            $items[] = [
                'id' => 'logout',
                'label' => $this->authService->getIdentity(),
                'float' => 'right',
                'dropdown' => [
                    [
                        'id' => 'settings',
                        'label' => 'Settings',
                        'link' => $url('application', ['action'=>'settings'])
                    ],
                    [
                        'id' => 'logout',
                        'label' => 'Sign out',
                        'link' => $url('logout')
                    ],
                ]
            ];
        }
        
        return $items;
    }
}


