import { Link } from "react-router-dom";

const Menu = () => {

    return(
        <div>
            <h2>Ola, Mundo!</h2>
            <h3>Aplicação de controle de doação de sangue</h3>

            <ul>
            <li><Link to="/">Inicio</Link></li>
            <li><Link to="/tipos">Tipos</Link> </li>
            <li><Link to="/doacoes">Doações</Link> </li>
            <li><Link to="/pessoas">Pessoas</Link> </li>
            <li><Link to="/locais">Locais</Link> </li>

            </ul>
            </div>
    );
    
}

export default Menu ;