import express from 'express';

import { mainRouter } from './routes/main.js';
import { tiposRouter } from './routes/tipos.js';
import { locaisRouter } from './routes/locais.js';
import { pessoasRouter } from './routes/pessoas.js';
import { doacoesRouter } from './routes/doacoes.js';

const PORT = 3333;

const app = express();
app.use(express.json());


    //Routes
    app.use(mainRouter);
    app.use(tiposRouter);
    app.use(locaisRouter);
    app.use(pessoasRouter);
    app.use(doacoesRouter);

    app.listen(PORT, () => {
    console.log(`[SERVER] Server is listening on port ${PORT}`);
    });
