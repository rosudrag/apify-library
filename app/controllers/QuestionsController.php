<?php
class QuestionsController extends Controller
{
    /**
     * @route GET /?method=domains
     * @route GET /domains
     * 
     * @param Request $request
     * @return Response|View
     */
    public function indexAction($request)
    {
        // serve HTML, JSON and XML
        $request->acceptContentTypes(array('html', 'json', 'xml'));
        
        if ('html' == $request->getContentType()) {
            $response = new View();
            $response->setLayout('main');
        } else {
            $response = new Response();
        }
        
        $response->questions = $this->getModel('Question')->findAll();
        return $response;
    }
    
    /**
     * @route GET /?method=domains.show&id=1
     * @route GET /?method=domains.show&id=matt
     * @route GET /domains/1
     * @route GET /domains/matt
     * 
     * @param Request $request
     * @return Response|View
     * @throws Exception
     */
    public function showAction($request)
    {
        // serve HTML, JSON and XML
        $request->acceptContentTypes(array('html', 'json', 'xml'));
        
        $model = $this->getModel('Question');
        $QuestionID = $request->getParam('QuestionID');
        $question = is_numeric($QuestionID) ? $model->find($QuestionID) : $model->findBy(array('Question'=>$Question));
        if (! $question) {
            throw new Exception('Question not found', Response::NOT_FOUND);
        }
        
        if ('html' == $request->getContentType()) {
            $response = new View();
            $response->setLayout('main');
        } else {
            $response = new Response();
            $response->setEtagHeader(md5('/questions/' . $question->id));
        }
        
        $response->question = $question; 
        return $response;
    }

    /**
     * @route POST /?method=domains.create&format=json
     * @route POST /domains/create.json
     * 
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function createAction($request)
    {
        $request->acceptContentTypes(array('json'));
        if ('POST' != $request->getMethod()) {
            throw new Exception('HTTP method not allowed', Response::NOT_ALLOWED);
        }
        
        try {
            $question = new Question(array(
                'Question'     => $request->getPost('Question'),
            ));
        } catch (ValidationException $e) {
            throw new Exception($e->getMessage(), Response::OK);
        }
        
        $QuestionID = $this->getModel('Question')->save($question);
        if (! is_numeric($QuestionID)) {
            throw new Exception('An error occurred while creating question', Response::OK);
        }
        
        $response = new Response();
        $response->setCode(Response::CREATED);
        $response->setEtagHeader(md5('/questions/' . $QuestionID));
        
        return $response;
    }

    /**
     * @route POST /?method=domains.update&id=1&format=json
     * @route POST /domains/1/update.json
     * 
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function updateAction($request)
    {
        $request->acceptContentTypes(array('json'));
        if ('POST' != $request->getMethod()) {
            throw new Exception('HTTP method not supported', Response::NOT_ALLOWED);
        }        
        
        $QuestionID = $request->getParam('QuestionID');
        
        $model = $this->getModel('Question');
        $question = $model->find($QuestionID);
        if (! $question) {
            throw new Exception('Question not found', Response::NOT_FOUND);
        }
        
        try {
            $question->Question = $request->getPost('Question');            
        } catch (ValidationException $e) {
            throw new Exception($e->getMessage(), Response::OK);
        }
        $model->save($question);
        
        // return 200 OK
        return new Response();
    }
    
    /**
     * @route GET /?method=domains.destroy&id=1&format=json
     * @route GET /domains/1/destroy.json
     * 
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function destroyAction($request)
    {
        $request->acceptContentTypes(array('json'));
        
        $QuestionID = $request->getParam('QuestionID');
        $model = $this->getModel('Question');
        $question = $model->find($QuestionID);
        if (! $question) {
            throw new Exception('Question not found', Response::NOT_FOUND);
        }
        $model->delete($question->id);
        
        // return 200 OK
        return new Response();
    }
}
