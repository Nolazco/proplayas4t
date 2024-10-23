<?php 

namespace App\Entity;

enum NodeTypes: string
{
	case SOCIAL = "Activista/Soc Civil";
	case CIENT = "Cientifico";
	case EMP = "Empresarial";
	case PUB = "Funcion Publica";
	case DEFAULT = "Na";
}