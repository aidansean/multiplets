from project_module import project_object, image_object, link_object, challenge_object

p = project_object('multiplets', 'Particle multiplets')
p.domain = 'http://www.aidansean.com/'
p.path = 'multiplets'
p.preview_image_ = image_object('http://placekitten.com.s3.amazonaws.com/homepage-samples/408/287.jpg', 408, 287)
p.github_repo_name = 'multiplets'
p.mathjax = True
p.links.append(link_object(p.domain, 'multiplets', 'Live page'))
p.introduction = 'For my thesis I needed to describe many of the know mesons and baryons.  To better illustrate their relation to each other I decided to create an SVG image showing a three dimensional representation in isospin and weak hypercharge space.'
p.overview = '''The multiplets are constructed from a series of points, wires and polygons.  These are then rotated using two of three Euler angles (the rotation about the intrinsic \(z\) axis is not useful in this case) and the resulting SVG document is written server side using PHP.  The client is then left to render the image.

Like many of my projects from the PhD era this suffers from a common problem: this project was developed when SVG was the best available technology for generating vector graphics on the fly, and as a result requires either a server side response (slow) or embedded Javascript (messy) to operate.  This project could benefit from being migrated to the canvas.'''

p.challenges.append(challenge_object('The SVG image had to be rendered in such a way that objects were not obscured in the 3D view.', 'This was one of the first projects where I had to write a simple 3D viewer from scratch, and I opted to use the median dstance of an object form the viewer to determine the order in which to draw the objects.  There were a few minor tweaks to acount for instances where this was not always successful, but the overall result was efficienct and overall I am pleased with the solution.  This is very similar to the techniques I used for the EMC viewer and the aDetector project.', 'Resolved'))

p.challenges.append(challenge_object('This project allows the user to rotate the multiplets and the rotation must be intuitive.', 'This is only really meant to be used by physicists who are used to thinking with angles, and used to poor user interfaces, so given the audience I would say that the user interactions is a big success.  However the page still makes requests to the server, meaning that the rotations do not happen in real time, and in the case of mutiple requests could lead to a large overhead on the server.  In the future this should be handled client side to free up server side resources and speed up the user experience.', 'Resolved'))
