# YiiStranaAdapter
Yii record adapter for Strana pagination composer package.

# Installation
Include the repository and require in your composer.json file:

    "require": {
        "lincsanders/yii_strana_adapter": "dev-master",
        ...
    }

For more info, see https://packagist.org/packages/lincsanders/yii_strana_adapter

# Usage
The usage is a little clunky, but it works. This is essentially a modified version of the "use your own adapter" example straight from https://github.com/usmanhalalit/strana. Substitute "User::model()" with your own stuff.

    $strana = new\Strana\Paginator();
    $configHelper = new \Strana\ConfigHelper($strana->perPage(5)->getConfig());
    $adapter = new YiiStranaAdapter(User::model(), $configHelper);
    $paginator = $strana->make(User::model(), $adapter);

This can be used in conjunction with something like the below to create your own paginated search results:
    
    $criteria = new CDbCriteria;
    
    if($_GET['search']){
        $criteria->addSearchCondition('username', $_GET['search']);
    }

    $model = User::model();
    $model->setDbCriteria($criteria);
    
    $strana = new \Strana\Paginator();
    $configHelper = new \Strana\ConfigHelper($strana->perPage(5)->getConfig());
    $adapter = new YiiStranaAdapter($model, $configHelper);
    $paginator = $strana->make($model, $adapter);
