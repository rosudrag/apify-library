<?php
class DomainsController extends Controller
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
        
        $response->domains = $this->getModel('Domain')->findAll();
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
        
        $model = $this->getModel('Domain');
        $id = $request->getParam('DomainID');
        $domain = is_numeric($id) ? $model->find($id) : $model->findBy(array('DomainName'=>$id));
        if (! $domain) {
            throw new Exception('Domain not found', Response::NOT_FOUND);
        }
        
        if ('html' == $request->getContentType()) {
            $response = new View();
            $response->setLayout('main');
        } else {
            $response = new Response();
            $response->setEtagHeader(md5('/domains/' . $domain->id));
        }
        
        $response->domain = $domain; 
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
            $domain = new Domain(array(
                'DomainName'     => $request->getPost('DomainName'),
            ));
        } catch (ValidationException $e) {
            throw new Exception($e->getMessage(), Response::OK);
        }
        
        $id = $this->getModel('Domain')->save($domain);
        if (! is_numeric($id)) {
            throw new Exception('An error occurred while creating domain', Response::OK);
        }
        
        $response = new Response();
        $response->setCode(Response::CREATED);
        $response->setEtagHeader(md5('/domains/' . $id));
        
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
        
        $id = $request->getParam('DomainID');
        
        $model = $this->getModel('Domain');
        $domain = $model->find($id);
        if (! $domain) {
            throw new Exception('Domain not found', Response::NOT_FOUND);
        }
        
        try {
            $domain->DomainName = $request->getPost('DomainName');            
        } catch (ValidationException $e) {
            throw new Exception($e->getMessage(), Response::OK);
        }
        $model->save($domain);
        
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
        
        $id = $request->getParam('DomainID');
        $model = $this->getModel('Domain');
        $domain = $model->find($id);
        if (! $domain) {
            throw new Exception('Domain not found', Response::NOT_FOUND);
        }
        $model->delete($domain->id);
        
        // return 200 OK
        return new Response();
    }
}
