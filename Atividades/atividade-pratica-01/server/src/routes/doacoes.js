import { Router } from 'express';
import { GetAllDoacoesController } from '../controller/doacoes/GetAllDoacoesController.js';
import { GetByIdDoacoesController } from '../controller/doacoes/GetByIdDoacoesController.js';
import { CreateDoacoesController } from '../controller/doacoes/CreateDoacoesController.js';
import { UpdateDoacoesController } from '../controller/doacoes/UpdateDoacoesController.js';
import { DeleteDoacoesController } from '../controller/doacoes/DeleteDoacoesController.js';
const doacoesRouter = Router();

//CRUD - DOACOES

//SELECT/GET ALL
const getAllDoacoesController = new GetAllDoacoesController();
doacoesRouter.get('/doacoes', getAllDoacoesController.handle);

//GET BY ID
const getByIdDoacoesController = new GetByIdDoacoesController();
doacoesRouter.get('/doacoes/:id', getByIdDoacoesController.handle);

//CREATE
const createDoacoesController = new CreateDoacoesController();
doacoesRouter.post('/doacoes', createDoacoesController.handle);

//UPDATE
const updateDoacoesController = new UpdateDoacoesController();
doacoesRouter.put('/doacoes', updateDoacoesController.handle);

//DELETE
const deleteDoacoesController = new DeleteDoacoesController();
doacoesRouter.delete('/doacoes', deleteDoacoesController.handle);

export { doacoesRouter };