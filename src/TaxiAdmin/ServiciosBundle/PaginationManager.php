<?php

namespace TaxiAdmin\ServiciosBundle;

use Knp\Component\Pager\Paginator;

class PaginationManager {

	protected $knp;
	protected $elemPagina;

	public function __construct(Paginator $knp, $elemPagina) {
		$this->knp = $knp;
		$this->elemPagina = $elemPagina;
	}

	public function getPagination($query, $pagina, $sortOrder, $elemPagina = null){
        // Añadimos el paginador (En este caso el parámetro "1" es la página actual, y parámetro "10" es el número de páginas a mostrar)
		return $this->knp->paginate(
			$query, 
			$pagina, 
			$elemPagina == null ? $this->elemPagina : $elemPagina, 
			$sortOrder
			);
	}
}