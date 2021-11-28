<?php

function activePage($page): string {
    return stripos($_SESSION['REAL_ROUTE'], $page) ? 'active' : '';
}