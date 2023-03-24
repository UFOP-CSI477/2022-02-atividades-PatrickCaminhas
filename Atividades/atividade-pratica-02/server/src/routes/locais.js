import { Router } from 'express';
import { GetAllLocaisController } from '../controller/locais/GetAllLocaisController.js';
import { GetByIdLocaisController } from '../controller/locais/GetByIdLocaisController.js';
import { CreateLocaisController } from '../controller/locais/CreateLocaisController.js';
import { UpdateLocaisController } from '../controller/locais/UpdateLocaisController.js';
import { DeleteLocaisController } from '../controller/locais/DeleteLocaisController.js';
const locaisRouter = Router();


//CRUD - LOCAIS

//SELECT/GET ALL
const getAllLocaisController = new GetAllLocaisController();
locaisRouter.get('/locais', getAllLocaisController.handle);

//GET BY ID
const getByIdLocaisController = new GetByIdLocaisController();
locaisRouter.get('/locais/:id', getByIdLocaisController.handle);

//CREATE
const createLocaisController = new CreateLocaisController();
locaisRouter.post('/locais', createLocaisController.handle);

//UPDATE
const updateLocaisController = new UpdateLocaisController();
locaisRouter.put('/locais', updateLocaisController.handle);

//DELETE
const deleteLocaisController = new DeleteLocaisController();
locaisRouter.delete('/locais', deleteLocaisController.handle);

export { locaisRouter };